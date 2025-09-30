<?php

namespace Mog;

class MogManager
{
    /**
     * Parse aspect ratio string into a float value.
     *
     * Accepts formats like "16/9", "4/3", or numeric strings.
     * Returns a float representing the aspect ratio.
     *
     * @param  string|float|int  $ratio  The ratio to parse
     * @return float The parsed ratio as a float
     */
    public function parseAspectRatio(int|string|float $ratio): float
    {
        if (is_string($ratio)) {
            $parts = explode('/', trim($ratio));
            if (count($parts) === 2 && is_numeric($parts[0]) && is_numeric($parts[1]) && (float) $parts[1] != 0) {
                return floatval($parts[0]) / floatval($parts[1]);
            }

            if (is_numeric($ratio)) {
                return floatval($ratio);
            }

            return 1.0; // fallback to 1:1 if invalid
        }

        return (float) $ratio;
    }
}
