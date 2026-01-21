<?php

namespace Mog\Blade\Compilers;

use Illuminate\Support\Str;
use Override;

/**
 * Handles self-closing slot syntax for more concise component definitions.
 *
 * Allows slots to be written as <x-slot:name /> instead of <x-slot:name></x-slot>.
 */
class SelfClosingSlotsCompiler extends BaseSlotCompiler
{
    #[Override]
    public function compileSlots(string $value): string
    {
        $pattern = "/
            <
                \s*
                x[\-\:]slot
                (?:\:(?<inlineName>\w+(?:-\w+)*))?
                (?:\s+name=(?<name>(\"[^\"]+\"|\\\'[^\\\']+\\\'|[^\s>]+)))?
                (?:\s+\:name=(?<boundName>(\"[^\"]+\"|\\\'[^\\\']+\\\'|[^\s>]+)))?
                (?<attributes>
                    (?:
                        \s+
                        (?:
                            (?:
                                @(?:class)(\( (?: (?>[^()]+) | (?-1) )* \))
                            )
                            |
                            (?:
                                @(?:style)(\( (?: (?>[^()]+) | (?-1) )* \))
                            )
                            |
                            (?:
                                \{\{\s*\\\$attributes(?:[^}]+?)?\s*\}\}
                            )
                            |
                            (?:
                                [\w\-:.@]+
                                (
                                    =
                                    (?:
                                        \\\"[^\\\"]*\\\"
                                        |
                                        \'[^\']*\'
                                        |
                                        [^\'\\\"=<>]+
                                    )
                                )?
                            )
                        )
                    )*
                    \s*
                )
                (?<![\/=\-])
                (?<selfClosing>\s*\/\s*)?
            >
        /x";

        /** @var string */
        $value = preg_replace_callback($pattern, function (array $matches): string {
            $name = $this->stripQuotes($matches['inlineName'] ?: $matches['name'] ?: $matches['boundName']);

            if (Str::contains($name, '-') && ! empty($matches['inlineName'])) {
                $name = Str::camel($name);
            }

            // If the name was given as a simple string, we will wrap it in quotes as if it was bound for convenience...
            if (! empty($matches['inlineName']) || ! empty($matches['name']) || ! empty($matches['boundName'])) {
                $name = "'{$name}'";
            }

            $this->boundAttributes = [];

            $attributes = $this->getAttributesFromAttributeString($matches['attributes']);

            // If an inline name was provided and a name or bound name was *also* provided, we will assume the name should be an attribute...
            if (! empty($matches['inlineName']) && (! empty($matches['name']) || ! empty($matches['boundName']))) {
                $attributes = ! empty($matches['name'])
                    ? array_merge($attributes, $this->getAttributesFromAttributeString('name='.$matches['name']))
                    : array_merge($attributes, $this->getAttributesFromAttributeString(':name='.$matches['boundName']));
            }

            $maybeClose = isset($matches['selfClosing']) ? '@endslot' : '';

            return " @slot({$name}, null, [".$this->attributesToString($attributes).']) '.$maybeClose;
        }, $value);

        return $value;
    }

    #[Override]
    public function compile(string $value): string
    {
        return $this->compileSlots($value);
    }
}
