<?php

/**
 * Class Router to route the controller
 */
class Router
{
    /**
     * Associative array of routes (the routing table)
     * @var array
     */
    protected  $routes = [];

    /**
     * Parameters from the matched route
     * @var array
     */
    protected $params = [];

    /**
     * Add a route to the routing table
     * @param string $route The Route URL
     * @param array $params Parameters (controller, action, etc.)
     */
    public function add($route, $params)
    {
        $this->routes[$route] = $params;
    }

    /**
     * Get all the routes from the routing table
     * @return array
     */
    public function getRoutes() {
        return $this->routes;

    }

    /**
     * Match the route to the routes in the ouritng table, setting the $params
     * property if a route is found.
     * @param $url The route URL
     * @return bool true if a match found, false otherwise.
     */
    public function match($url) {
        /*foreach ($this->routes as $route => $params) {
            if ($url == $route) {
                $this->params = $params;
                return true;
            }
        } */

        // Match to the fixed url format /controller/action
        $reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";

        if (preg_match($reg_exp, $url, $matches)) {
            // Get named capture value groups
            $params = [];

            foreach ($matches as $key => $match) {
                if (is_string($key)) {
                    $params[$key] = $match;
                }
            }
            $this->params = $params;
            return true;
        }

        return false;
    }

    /**
     * Get the currently mathced parameters
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

}