<?php

namespace Mog\Blade;

use Illuminate\Support\Str;
use Illuminate\View\ComponentSlot;
use Illuminate\View\Concerns\ManagesComponents;

class CustomCompiler
{
    use ManagesComponents;

    public static function compileArraySlot(string $expression): string
    {
        return "<?php \$__env->arraySlot({$expression}); ?>";
    }

    public static function compileEndArraySlot(string $expression): string
    {
        return '<?php $__env->endArraySlot(); ?>';
    }

    public static function compileArraySlotDirective()
    {
        return function ($name, $attributes = []) {
            $name = Str::startsWith($name, ['[']) && Str::endsWith($name, [']']) ? substr($name, 1, -1) : $name;

            if (ob_start()) {
                $slotIndex = count($this->slots[$this->currentComponent()][$name] ?? ['']) - 1;
                // $this->slots[$this->currentComponent()][$name] = '';
                $this->slotStack[$this->currentComponent()][] = [$name, $attributes];
            }
        };
    }

    public static function compileEndArraySlotDirective()
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
