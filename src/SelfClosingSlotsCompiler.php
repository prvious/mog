<?php

namespace Mog;

use Illuminate\Support\Str;
use Illuminate\View\Compilers\ComponentTagCompiler;
use Override;

class SelfClosingSlotsCompiler extends ComponentTagCompiler
{
    #[Override]
    public function compileSlots(string $value): string
    {
        $pattern = "/
            <
                \s*
                x[\-\:]slot
                (?:\:(?<inlineName>\w+(?:-\w+)*))?
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
            \/>
        /x";

        return preg_replace_callback($pattern, function ($matches) {
            $name = $this->stripQuotes($matches['inlineName']);

            $name = Str::replace(['[', ']'], '', $name);

            if (Str::contains($name, '-') && ! empty($matches['inlineName'])) {
                $name = Str::camel($name);
            }

            $this->boundAttributes = [];

            $attributes = trim($matches['attributes']);

            return "<x-slot:{$name} {$attributes}> </x-slot:{$name}>";
        }, $value);
    }

    #[Override]
    public function compile(string $value)
    {
        $value = $this->compileSlots($value);

        return $value;
    }
}
