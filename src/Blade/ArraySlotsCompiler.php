<?php

namespace Mog\Blade;

use Illuminate\Support\Str;
use Illuminate\View\Compilers\ComponentTagCompiler;
use Override;

// Transforms array slots syntax into @arraySlot() directives.
class ArraySlotsCompiler extends ComponentTagCompiler
{
    #[Override]
    public function compile($value)
    {
        $pattern = "/
            <
                \s*
                x[\-\:]slot
                \:(?<inlineName>\[\w+(?:-\w+)*\])
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
                (?:(?<selfClosing>\s*\/>)|(?:\s*>))
        /x";

        $value = preg_replace_callback($pattern, function ($matches) {
            $name = $this->stripQuotes($matches['inlineName']);

            if (Str::contains($name, '-')) {
                $name = Str::camel($name);
            }

            // Wrap in quotes
            $name = "'{$name}'";

            $this->boundAttributes = [];

            $attributes = $this->getAttributesFromAttributeString($matches['attributes']);

            $maybeClose = isset($matches['selfClosing']) ? '@endArraySlot' : '';

            return " @arraySlot({$name}, [".$this->attributesToString($attributes).']) '.$maybeClose;
        }, $value);

        // Replace the first N </x-slot:[name]> or </x:slot:[name]> tags with @endArraySlot
        $value = preg_replace('/<\/x[\-\:]slot:\[\w+(?:-\w+)*\]>/', ' @endArraySlot', $value);

        return $value;
    }
}
