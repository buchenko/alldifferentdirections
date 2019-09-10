<?php

namespace buchenko\alldifferentdirections;

/**
 * Class Service
 * @package buchenko\alldifferentdirections
 */
class Service
{
    /**
     * @var \buchenko\alldifferentdirections\Route[]
     */
    protected $routes;

    /**
     * @var \buchenko\alldifferentdirections\Point
     */
    private $averagePoint;

    /**
     * @var \buchenko\alldifferentdirections\Point[]
     */
    private $points;


    /**
     * Service constructor.
     *
     * @param Route[] $routes
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * prepare points[] and averagePoint from routes[]
     */
    public function prepare(): void
    {
        if (empty($this->routes)) {
            throw new \LogicException('Empty routes');
        }
        $x = 0;
        $y = 0;
        foreach ($this->routes as $route) {
            $point = $route->build();
            $x += $point->getX();
            $y += $point->getY();
            $this->points[] = $point;
        }
        $count = count($this->routes);
        $this->averagePoint = new Point($x / $count, $y / $count);
    }

    /**
     * @return \buchenko\alldifferentdirections\Point
     */
    public function getAverage(): Point
    {
        if (!isset($this->averagePoint)) {
            $this->prepare();
        }

        return $this->averagePoint;
    }

    /**
     * @return float
     */
    public function getWorstDistance(): float
    {
        $worstDistance = 0;
        if (!isset($this->averagePoint)) {
            $this->prepare();
        }
        foreach ($this->points as $point) {
            $worstDistance = max($worstDistance, static::getDistance($point, $this->averagePoint));
        }

        return $worstDistance;
    }

    /**
     * @param \buchenko\alldifferentdirections\Point $start
     * @param \buchenko\alldifferentdirections\Point $end
     *
     * @return float
     */
    public static function getDistance(Point $start, Point $end): float
    {
        return sqrt(($start->getX() - $end->getX()) ** 2 + ($start->getY() - $end->getY()) ** 2);
    }
}