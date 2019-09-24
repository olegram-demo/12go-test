<?php

declare(strict_types=1);

class Track
{
    /**
     * @var float
     */
    protected $currentX;

    /**
     * @var float
     */
    protected $currentY;

    /**
     * @var float
     */
    protected $currentDirection;

    /**
     * Track constructor.
     * @param float $initialX
     * @param float $initialY
     * @param float $initialDirection
     */
    public function __construct(float $initialX, float $initialY, float $initialDirection)
    {
        $this->currentX = $initialX;
        $this->currentY = $initialY;
        $this->currentDirection = $initialDirection;
    }

    /**
     * @return float
     */
    public function getCurrentX(): float
    {
        return $this->currentX;
    }

    /**
     * @return float
     */
    public function getCurrentY(): float
    {
        return $this->currentY;
    }

    /**
     * @param float $deg
     * @return $this
     */
    public function turn(float $deg): self
    {
        $this->currentDirection += $deg;

        return $this;
    }

    /**
     * @param float $distance
     * @return $this
     */
    public function walk(float $distance): self
    {
        $currentDirectionInRadians = deg2rad($this->currentDirection);

        $this->currentX += cos($currentDirectionInRadians) * $distance;
        $this->currentY += sin($currentDirectionInRadians) * $distance;

        return $this;
    }
}
