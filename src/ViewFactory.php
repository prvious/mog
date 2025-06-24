<?php

namespace Mog;

use Illuminate\View\ComponentSlot;
use Illuminate\View\Concerns\ManagesComponents;

class ViewFactory extends \Illuminate\View\Factory
{
    use ManagesComponents {
        slot as protected parentSlot;
        endSlot as protected parentEndSlot;
        componentData as protected parentComponentData;
    }

    /**
     * Override slot to support multiple slots with the same name.
     */
    public function slot($name, $content = null, $attributes = [])
    {
        if (func_num_args() === 2 || $content !== null) {
            // Wrap direct slot content in ComponentSlot to preserve attributes
            $this->slots[$this->currentComponent()][$name][] = new ComponentSlot($content, $attributes);
        } elseif (ob_start()) {
            // initialize slot array without placeholder
            if (! isset($this->slots[$this->currentComponent()][$name]) || ! is_array($this->slots[$this->currentComponent()][$name])) {
                $this->slots[$this->currentComponent()][$name] = [];
            }
            $this->slotStack[$this->currentComponent()][] = [$name, $attributes];
        }
    }

    /**
     * Override endSlot to push multiple slot contents.
     */
    public function endSlot()
    {
        last($this->componentStack);
        [$name, $attributes] = array_pop($this->slotStack[$this->currentComponent()]);
        $content = new ComponentSlot(trim(ob_get_clean()), $attributes);
        $this->slots[$this->currentComponent()][$name][] = $content;
    }

    /**
     * Override componentData to return arrays for slots and flatten rendering.
     */
    protected function componentData()
    {
        $defaultSlot = new ComponentSlot(trim(ob_get_clean()));
        $index = count($this->componentStack);
        $rawSlots = $this->slots[$index] ?? [];

        // Build array slots payload
        $arraySlots = ['__default' => $defaultSlot];
        foreach ($rawSlots as $slotName => $contents) {
            $arraySlots[$slotName] = is_array($contents) ? $contents : [$contents];
        }

        // Build default single value for rendering compatibility
        $renderSlots = ['__default' => $defaultSlot];
        foreach ($rawSlots as $slotName => $contents) {
            if (is_array($contents)) {
                // Combine multiple slot contents and preserve attributes from the first slot instance
                $combined = implode('', array_map(function ($slot) {
                    return (string) $slot;
                }, $contents));
                $attributes = [];
                if (isset($contents[0]) && $contents[0] instanceof ComponentSlot) {
                    $attributes = $contents[0]->attributes->all();
                }
                $renderSlots[$slotName] = new ComponentSlot($combined, $attributes);
            } else {
                $renderSlots[$slotName] = $contents;
            }
        }

        return array_merge(
            $this->componentData[$index],
            ['slot' => $defaultSlot],
            $renderSlots,
            ['__laravel_slots' => $arraySlots]
        );
    }
}
