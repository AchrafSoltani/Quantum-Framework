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

class App
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

}
