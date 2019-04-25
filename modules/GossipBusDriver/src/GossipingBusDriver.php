<?php

namespace App;

/**
 * Class GossipingBusDriver
 * @package App
 */
class GossipingBusDriver
{
    /**
     * @param array $routes
     * @return array
     */
    private function generateAllDayRoutes($routes)
    {
        foreach ($routes as &$routeStops) {
            $stops = count($routeStops);

            for ($i = 0; $i < 480; $i++) {
                if (!isset($routeStops[$i])) {
                    $offset = $i % $stops;
                    $routeStops[$i] = $routeStops[$offset];
                }
            }
        }

        return $routes;
    }

    /**
     * @param array $routes
     * @return int|mixed
     */
    private function compareGossipStops($routes)
    {
        $routeKeys = array_keys($routes);
        $options = $this->prepareAvailableOptions($routeKeys);
        $output = [];

        $counter = 1;
        for ($i = 0; $i < 480; $i++) {
            foreach ($options as $option) {
                $keys = str_split($option);
                if (!isset($output[$option])) {
                    if ($routes[$keys[0]][$i] === $routes[$keys[1]][$i]) {
                        $output[$option] = $counter;
                        $counter = 0;
                    }
                }
            }
            $counter++;
        }

        if (empty($output)) {
            return 0;
        }

        return max($output);
    }

    /**
     * @param array $keys
     * @return array
     */
    private function prepareAvailableOptions($keys)
    {
        $options = [];

        foreach ($keys as $key) {
            for ($i = $key; $i < count($keys); $i++) {
                if ($key != $i) {
                    $options[] = $key . $i;
                }
            }
        }

        return $options;
    }

    /**
     * @param int $result
     * @return string
     */
    private function generateOutput($result)
    {
        if (!$result) {
            return 'never';
        }

        return $result;
    }

    /**
     * @param array $routes
     * @return string
     */
    public function checkGossips($routes)
    {
        $routes = $this->generateAllDayRoutes($routes);
        $fullGossipSteps = $this->compareGossipStops($routes);

        return $this->generateOutput($fullGossipSteps);
    }
}

$routes = [
    [2, 1, 2],
    [5, 2, 8]
];
$routes = [
    [3, 1, 2, 3],
    [3, 2, 3, 1],
    [4, 2, 3, 4, 5]
];

$a = new GossipingBusDriver();
$result = $a->checkGossips($routes);
