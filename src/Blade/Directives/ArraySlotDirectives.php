<?php

namespace Mog\Blade\Directives;

use Illuminate\Support\Str;
use Illuminate\View\ComponentSlot;
use Illuminate\View\Concerns\ManagesComponents;

class ArraySlotDirectives
{
    use ManagesComponents;

    /**
     * Compile the @arraySlot directive.
     */
    public static function compileArraySlot(string $expression): string
    {
        return "<?php \$__env->arraySlot({$expression}); ?>";
    }

    /**
     * Compile the @endArraySlot directive.
     */
    public static function compileEndArraySlot(string $expression): string
    {
        return '<?php $__env->endArraySlot(); ?>';
    }

    /**
     * Create the arraySlot View macro closure.
     *
     * This handles the runtime behavior of array slots when rendering.
     */
    public static function makeArraySlotMacro(): \Closure
    {
        return function ($name, $attributes = []) {
            $name = Str::startsWith($name, ['[']) && Str::endsWith($name, [']']) ? substr($name, 1, -1) : $name;

            if (ob_start()) {
                $slotIndex = count($this->slots[$this->currentComponent()][$name] ?? ['']) - 1;
                $this->slotStack[$this->currentComponent()][] = [$name, $attributes];
            }
        };
    }

    /**
     * Create the endArraySlot View macro closure.
     *
     * This handles closing the array slot and storing the content.
     */
    public static function makeEndArraySlotMacro(): \Closure
    {
        return function () {
            last($this->componentStack);

            $currentSlot = last($this->slotStack[$this->currentComponent()]);

            [$currentName, $currentAttributes] = $currentSlot;

            $this->slots[$this->currentComponent()][$currentName][] = new ComponentSlot(
                trim(ob_get_clean()), $currentAttributes,
            );

            array_pop(
                $this->slotStack[$this->currentComponent()],
            );
        };
    }
}
