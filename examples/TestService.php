<?php

namespace buchenko\alldifferentdirections\examples;

use buchenko\alldifferentdirections\Route;
use buchenko\alldifferentdirections\Point;
use buchenko\alldifferentdirections\Service;

/**
 * Class TestService
 * @package buchenko\alldifferentdirections\examples
 */
class TestService
{
    /*
    87.342 34.30 start 0 walk 10.0
    2.6762 75.2811 start -45.0 walk 40 turn 40.0 walk 60
    58.518 93.508 start 270 walk 50 turn 90 walk 40 turn 13 walk 5
    */
    public static function test1()
    {
        $route = new Route(new Point(87.342, 34.30));
        $route->addWalk(10);
        $routes[] = $route;

        $route = new Route(new Point(2.6762, 75.2811), -45.0);
        $route->addWalk(40)
        ->addTurn(40)
        ->addWalk(60);
        $routes[] = $route;

        $route = new Route(new Point(58.518, 93.508), 270);
        $route->addWalk(50)
        ->addTurn(90)
        ->addWalk(40)
        ->addTurn(13)
        ->addWalk(5);
        $routes[] = $route;

        $service = new Service($routes);
        echo 'Average: ' . $service->getAverage()->toPrint();
        echo "\n";
        echo 'The distance between the worst directions and the averaged destination: ' . $service->getWorstDistance();
        echo "\n";
    }

    /*
    30 40 start 90 walk 5
    40 50 start 180 walk 10 turn 90 walk 5
    */
    public static function test2()
    {
        $route = new Route(new Point(30, 40), 90);
        $route->addWalk(5);
        $routes[] = $route;

        $route = new Route(new Point(40, 50), 180);
        $route->addWalk(10)
        ->addTurn(90)
        ->addWalk(5);
        $routes[] = $route;

        $service = new Service($routes);
        echo 'Average: ' . $service->getAverage()->toPrint();
        echo "\n";
        echo 'The distance between the worst directions and the averaged destination: ' . $service->getWorstDistance();
        echo "\n";
    }

    public static function test3()
    {
        $route = new Route(new Point(30, 40), 90);
        $route->addWalk(5);
        $routes[] = $route;

        $route = new Route(new Point(40, 50), 180);
        $route->addWalk(10)
        ->addTurn(90)
        ->addTurn(10)
        ->addWalk(5)
        ->addWalk(25)
        ->addTurn(-15)
        ->addWalk(15);
        $routes[] = $route;

        $service = new Service($routes);
        echo 'Average: ' . $service->getAverage()->toPrint();
        echo "\n";
        echo 'The distance between the worst directions and the averaged destination: ' . $service->getWorstDistance();
        echo "\n";
    }

}