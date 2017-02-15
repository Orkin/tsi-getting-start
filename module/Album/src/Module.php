<?php
/**
 * User: orkin
 * Date: 13/02/2017
 * Time: 16:55
 */
declare(strict_types = 1);


namespace Album;


use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
