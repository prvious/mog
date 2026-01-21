<?php

namespace Mog\Theme;

/**
 * Manages overlay rendering state.
 *
 * OCTANE-SAFE: This class uses static state that is automatically flushed
 * between requests via Laravel Octane's OperationTerminated event or at
 * request termination, ensuring state isolation.
 */
class OverlayManager
{
    /**
     * Indicates if the overlay has already been rendered in the current request.
     *
     * This is reset between Octane requests automatically.
     */
    private static bool $overlayRendered = false;

    /**
     * Flush the static state.
     *
     * This is called automatically by MogServiceProvider when handling
     * Octane's OperationTerminated event or at request termination.
     */
    public static function flushState(): void
    {
        static::$overlayRendered = false;
    }

    /**
     * Check if the overlay has already been rendered in the current request.
     *
     * This method is Octane-safe as the static state is flushed between requests.
     */
    public function hasRenderedOverlay(): bool
    {
        return static::$overlayRendered;
    }

    /**
     * Mark the overlay as rendered for the current request.
     *
     * This method is Octane-safe as the static state is flushed between requests.
     */
    public function setOverlayRendered(): void
    {
        static::$overlayRendered = true;
    }

    /**
     * @deprecated Use hasRenderedOverlay() instead
     */
    public function overlayAlreadyRendered(): bool
    {
        return $this->hasRenderedOverlay();
    }

    /**
     * @deprecated Use setOverlayRendered() instead
     */
    public function markOverlayAsRendered(): void
    {
        $this->setOverlayRendered();
    }
}
