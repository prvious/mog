<?php

namespace Mog;

use Mog\Assets\ScriptAssetManager;
use Mog\Theme\OverlayManager;
use Mog\Utilities\AspectRatioParser;
use TalesFromADev\TailwindMerge\TailwindMergeInterface;

/**
 * Core manager class for the Mog package.
 *
 * This class acts as a facade/coordinator that delegates to specialized services.
 * It maintains backward compatibility while the actual logic lives in dedicated classes.
 */
class MogManager
{
    public function __construct(
        private TailwindMergeInterface $tailwindMerge,
        private AspectRatioParser $aspectRatioParser,
        private OverlayManager $overlayManager,
        private ScriptAssetManager $scriptAssetManager
    ) {}

    /**
     * Parse aspect ratio string into a float value.
     *
     * Delegates to AspectRatioParser service.
     *
     * @param  string|float|int  $ratio  The ratio to parse
     * @return float The parsed ratio as a float
     */
    public function parseAspectRatio(int|string|float $ratio): float
    {
        return $this->aspectRatioParser->parse($ratio);
    }

    /**
     * Check if the overlay has already been rendered.
     *
     * Delegates to OverlayManager service.
     */
    public function overlayAlreadyRendered(): bool
    {
        return $this->overlayManager->hasRenderedOverlay();
    }

    /**
     * Mark the overlay as rendered.
     *
     * Delegates to OverlayManager service.
     */
    public function markOverlayAsRendered(): void
    {
        $this->overlayManager->setOverlayRendered();
    }

    /**
     * Merge CSS classes using TailwindMerge.
     *
     * Intelligently merges Tailwind CSS classes, handling conflicts.
     *
     * @param  array<array-key, string|array<array-key, string>>  ...$args
     */
    public function cn(...$args): string
    {
        return $this->tailwindMerge->merge(...$args);
    }

    /**
     * Generate a script tag for the Mog JavaScript file.
     *
     * Delegates to ScriptAssetManager service.
     *
     * @return string The complete script tag with attributes
     */
    public function script(): string
    {
        return $this->scriptAssetManager->scriptTag();
    }
}
