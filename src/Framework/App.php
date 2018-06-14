<?php

/**
 * Core class of Quantum Framework.
 *
 * This is the app singleton that will handle all the framework's operations
 *
 * @category Core
 * @author Achraf Soltani
 * @copyright (c) 2018, Achraf Soltani
 * @license http://opensource.org/licenses/MIT The MIT License
 * @link https://github.com/AchrafSoltani/Quantum-Framework GitHub Repository
 * @link http://www.achrafsoltani.com website
 */

namespace Quantum\Framework;

use League\Container\Container;
use League\Route\RouteCollection;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Response\SapiEmitter;

 class App extends Container
 {
     private $config;
     private $routeCollection;

     public function __construct($config)
     {
         parent::__construct();
         $this->config = $config;
         $this->routeCollection = new RouteCollection($this);

         $this->share('response', Response::class);
         $this->share('request', function () {
            return ServerRequestFactory::fromGlobals(
                $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
            );
        });
        $this->share('emitter', SapiEmitter::class);

        $this->compileRoutes();
     }

     public function compileRoutes()
     {
        foreach ($this->config['routes'] as $route) {
            $tmp = explode("::", $route[2]);
            $controller = $tmp[0]."Controller";
            $action = $tmp[1]."Action";
            $class = 'App\Controller\\'.$controller;
            //$obj = new $class();
            $this->routeCollection->map($route[0], $route[1], array(new $class(), $action));
        }
     }

     public function dispatch()
     {
        $response = $this->routeCollection->dispatch($this->get('request'), $this->get('response'));
        $this->get('emitter')->emit($response);
     }

 }
