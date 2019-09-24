<?php

declare(strict_types=1);

require_once __DIR__ . '/Track.php';

class TrackFactory
{
    protected const TURN = 'turn';
    protected const WALK = 'walk';

    public static function createFromRawData(string $data): Track
    {
        $parts = explode(' ', $data);

        $track = new Track((float) $parts[0], (float) $parts[1], (float) $parts[3]);

        for ($i = 4, $l = count($parts); $i < $l; $i += 2) {
            if ($parts[$i] === static::TURN) {
                $track->turn((float) $parts[$i+1]);
            } elseif ($parts[$i] === static::WALK) {
                $track->walk((float) $parts[$i+1]);
            }
        }

        return $track;
    }
}
