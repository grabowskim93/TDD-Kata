<?php

namespace Tests;

use App\GossipingBusDriver\GossipingBusDriver;
use PHPUnit\Framework\TestCase;

class GossipingBusDriversTest extends TestCase
{
    /**
     * @return array
     */
    public function driverProvider()
    {
        return [
            [2]
        ];
    }

    /**
     * @return array
     */
    public function driverRoutesProvider()
    {
        return [
            [
                [
                    [3, 1, 2, 3],
                    [3, 2, 3, 1],
                    [4, 2, 3, 4, 5]
                ]
            ],
            [
                [
                    [2, 1, 2],
                    [5, 2, 8]
                ]
            ]
        ];
    }

    public function testGossipingBusDriversExists()
    {
        $gossipingBusDrivers = new GossipingBusDriver();
        $class = $gossipingBusDrivers instanceof GossipingBusDriver;

        self::assertEquals(true, $class);
    }

    /**
     * @dataProvider driverProvider
     * @param int $drivers
     */
    public function testDrivers($drivers)
    {
        self::assertEquals(2, $drivers);
    }

    /**
     * @dataProvider driverRoutesProvider
     * @param array $routes
     * @return array
     */
    public function testRoutes($routes)
    {
        self::assertIsArray($routes);
        return $routes;
    }

    //DONT KNOW WHAT ABOUT PREVIOUS PUBLIC METHOD WHICH ARE NOW PRIVATE!!!!
//    /**
//     * @dataProvider driverRoutesProvider
//     * @param array $routes
//     * @return array
//     */
//    public function testAllDayRoutes($routes)
//    {
//        $gossipingBusDrivers = new GossipingBusDriver();
//        $allDayRoutes = $gossipingBusDrivers->generateAllDayRoutes($routes);
//
//        foreach ($allDayRoutes as $route) {
//            self::assertEquals(480, count($route));
//        }
//
//        return $allDayRoutes;
//    }
//
//    /**
//     * @dataProvider driverRoutesProvider
//     */
//    public function testCompareRouteStops($routes)
//    {
//        $gossipingBusDrivers = new GossipingBusDriver();
//        $allDayRoutes = $gossipingBusDrivers->generateAllDayRoutes($routes);
//        $gossipStopNumber = $gossipingBusDrivers->compareGossipStops($allDayRoutes);
//
//        self::assertIsInt($gossipStopNumber);
//    }*/

    /**
     * @dataProvider driverRoutesProvider
     * @param array $routes
     */
    public function testBusDriverGossip($routes)
    {
        $gossipingBusDrivers = new GossipingBusDriver();
        $result = $gossipingBusDrivers->checkGossips($routes);

        if (is_int($result)) {
            self::assertIsInt($result);
        } else {
            self::assertEquals('never', $result);
        }
    }
}
