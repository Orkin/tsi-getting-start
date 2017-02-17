<?php
/**
 * User: orkin
 * Date: 15/02/2017
 * Time: 15:56
 */
declare(strict_types = 1);


namespace Legal;


use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
