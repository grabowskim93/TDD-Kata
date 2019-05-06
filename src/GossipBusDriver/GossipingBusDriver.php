<?php

declare(strict_types = 1);


namespace App\GossipBusDriver;

/**
 * Class GossipingBusDriver
 * @package App
 */
class GossipingBusDriver
{
    /**
     * Amount of meetings during work week
     */
    const FULL_WEEK_MEETINGS_AMOUNT = 480;

    /**
     * @param array $routes
     * @return array
     */
    private function generateAllDayRoutes(array $routes) : array
    {
        foreach ($routes as &$routeStops) {
            $stops = count($routeStops);

            for ($i = 0; $i < self::FULL_WEEK_MEETINGS_AMOUNT; $i++) {
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
    private function compareGossipStops(array $routes)
    {
        $routeKeys = array_keys($routes);
        $options = $this->prepareAvailableOptions($routeKeys);
        $output = [];

        $counter = 1;
        for ($i = 0; $i < self::FULL_WEEK_MEETINGS_AMOUNT; $i++) {
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
    private function prepareAvailableOptions(array $keys) : array
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
     * If drivers never meet it returns never
     *
     * @param int $result
     * @return string | int
     */
    private function generateOutput(int $result)
    {
        if (!$result) {
            return 'never';
        }

        return $result;
    }

    /**
     * @param array $routes
     * @return string | int
     */
    public function checkGossips(array $routes)
    {
        $routes = $this->generateAllDayRoutes($routes);
        $fullGossipSteps = $this->compareGossipStops($routes);

        return $this->generateOutput($fullGossipSteps);
    }
}
