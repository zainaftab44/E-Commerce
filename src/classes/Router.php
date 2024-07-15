<?php

namespace Src\Classes;

use Exception;
use Src\Interfaces\ControllerInterface;

/**
 * Class Router
 * @package src\classes
 *
 * Handles auto-routing for the application.
 */
class Router
{
    /**
     * Handles the routing logic.
     *
     * @param string $path The route path.
     * @return void
     */
    public function access(string $path): void
    {
        $logger = Logger::getInstance();

        $defaultResponse = [
            'status' => DEFAULT_STATUS,
            'message' => DEFAULT_MESSAGE,
        ];

        $pathSegments = explode('/', trim($path, '/'));
        $controllerName = !empty($pathSegments[0]) ? ucfirst($pathSegments[0]) . 'Controller' : null;
        $actionName = !empty($pathSegments[1]) ? explode('?', $pathSegments[1])[0]: 'index';

        try {
            if ($controllerName) {
                $controllerClass = DIRECTORY_SEPARATOR."src".DIRECTORY_SEPARATOR."controllers".DIRECTORY_SEPARATOR."$controllerName";
                if (class_exists($controllerClass)) {
                    $controller = new $controllerClass();
                    if ($controller instanceof ControllerInterface && method_exists($controller, $actionName)) {
                        $response = $controller->$actionName();
                    } else {
                        $logger->error_log("Action $actionName not found in controller $controllerClass.");
                    }
                } else {
                    $logger->error_log("Controller $controllerClass not found.");
                }
            } else {
                $logger->error_log("No controller specified.");
            }
        } catch (Exception $ex) {
            $logger->error($ex->getMessage(), $ex);
            $response = $defaultResponse;
        }

        $response = $response ?? $defaultResponse;
    }
}
