<?php
/**
 * User: orkin
 * Date: 15/02/2017
 * Time: 10:27
 */
declare(strict_types = 1);


namespace Blog;


use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
