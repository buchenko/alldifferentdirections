<?php

namespace buchenko\alldifferentdirections;

/**
 * Class Route
 * @package buchenko\alldifferentdirections
 */
class Route
{
    const TURN = 'turn';
    const WALK = 'walk';
    const MAX_COUNT_INSTRUCTIONS = 24;

    /**
     * @var \buchenko\alldifferentdirections\Point
     */
    protected $location;

    /**
     * @var float
     */
    protected $start;

    /**
     * @var array
     */
    protected $instructions = [];


    /**
     * Route constructor.
     *
     * @param \buchenko\alldifferentdirections\Point $location
     * @param float $start
     */
    public function __construct(Point $location, float $start = 0)
    {
        $this->location = $location;
        $this->start = $start;
    }

    /**
     * @param float $degree
     *
     * @return \buchenko\alldifferentdirections\Route
     */
    public function addTurn(float $degree): Route
    {
        if (count($this->instructions) == self::MAX_COUNT_INSTRUCTIONS){
            throw new \LogicException("Allow only " . self::MAX_COUNT_INSTRUCTIONS . " instructions");
        }
        $this->instructions[self::TURN] = $degree;

        return $this;
    }

    /**
     * @param float $numberOfUnits
     *
     * @return \buchenko\alldifferentdirections\Route
     */
    public function addWalk(float $numberOfUnits): Route
    {
        if (count($this->instructions) == self::MAX_COUNT_INSTRUCTIONS){
            throw new \LogicException("Allow only " . self::MAX_COUNT_INSTRUCTIONS . " instructions");
        }
        $this->instructions[self::WALK] = $numberOfUnits;

        return $this;
    }

    /**
     * @return \buchenko\alldifferentdirections\Point
     */
    public function build(): Point
    {
        $x = $this->location->getX();
        $y = $this->location->getY();
        $degree = $this->start;
        foreach ($this->instructions as $instruction => $value) {
            if ($instruction == self::TURN) {
                $degree += $value;
            } elseif ($instruction == self::WALK) {
                $x += $value * cos(deg2rad($degree));
                $y += $value * sin(deg2rad($degree));
            }
        }
        $endPoint = new Point($x, $y);

        return $endPoint;
    }

}