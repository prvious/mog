<?php

namespace Mog\Blade\Compilers;

use Illuminate\View\Compilers\ComponentTagCompiler;

/**
 * Base compiler for slot-related compilation tasks.
 *
 * Provides shared regex patterns and utilities for slot compilers.
 */
abstract class BaseSlotCompiler extends ComponentTagCompiler
{
    /**
     * Get the common attribute regex pattern used by slot compilers.
     *
     * This pattern matches various attribute formats including:
     * - @class() and @style() directives with nested parentheses
     * - {{ $attributes }} expressions
     * - Regular HTML attributes (name="value", :name="value", etc.)
     */
    protected function getAttributePattern(): string
    {
        return "
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
        ";
    }
}
