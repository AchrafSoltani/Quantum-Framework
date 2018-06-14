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
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

 class App extends Container
 {
     private $config;

     public function __construct($config = null)
     {
         parent::__construct();
         $this->config = $config;

         $this->share('response', Zend\Diactoros\Response::class);
         $this->share('request', function () {
            return Zend\Diactoros\ServerRequestFactory::fromGlobals(
                $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
            );
        });
        $this->share('emitter', Zend\Diactoros\Response\SapiEmitter::class);
     }



 }
