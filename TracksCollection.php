<?php

declare(strict_types=1);

require_once __DIR__ . '/Track.php';

class TracksCollection
{
    /** @var Track[] */
    protected $tracks = [];

    /**
     * @param Track $track
     * @return $this
     */
    public function addTrack(Track $track): self
    {
        $this->tracks[] = $track;

        return $this;
    }

    /**
     * @return array
     */
    public function calculateAverageCoordinates(): array
    {
        $l = count($this->tracks);

        if (! $l) {
            return [0, 0];
        }

        return [
            array_reduce($this->tracks, function (float $sum, Track $track) {
                return $sum + $track->getCurrentX();
            }, 0) / $l,
            array_reduce($this->tracks, function (float $sum, Track $track) {
                return $sum + $track->getCurrentY();
            }, 0) / $l
        ];
    }

    /**
     * @return float
     */
    public function calculateWorstDistance(): float
    {
        if (empty($this->tracks)) {
            return 0;
        }

        $averageCoordinates = $this->calculateAverageCoordinates();

        $distances = array_map(function (Track $track) use ($averageCoordinates) {
            return sqrt(
                ($track->getCurrentX() - $averageCoordinates[0]) ** 2
                + ($track->getCurrentY() - $averageCoordinates[1]) ** 2
            );
        }, $this->tracks);

        return max($distances);
    }
}
