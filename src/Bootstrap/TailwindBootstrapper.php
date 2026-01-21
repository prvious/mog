<?php

namespace Mog\Bootstrap;

use Illuminate\View\ComponentAttributeBag;
use TalesFromADev\TailwindMerge\TailwindMergeInterface;

class TailwindBootstrapper
{
    public function __construct(
        private TailwindMergeInterface $tailwindMerge
    ) {}

    /**
     * Boot TailwindMerge integration.
     *
     * Registers the 'cn' macro on ComponentAttributeBag to enable
     * class merging directly on component attributes.
     */
    public function bootMacro(): void
    {
        ComponentAttributeBag::macro('cn', function (...$args): ComponentAttributeBag {
            /** @var ComponentAttributeBag $this */
            $this->offsetSet('class', app(TailwindMergeInterface::class)->merge($args, $this->get('class', '')));

            return $this;
        });
    }
}
