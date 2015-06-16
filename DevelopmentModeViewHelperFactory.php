<?php

namespace ZF\DevelopmentMode;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DevelopmentModeViewHelperFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $configCacheDir = null;
        $configCacheKey = null;
        $services       = $serviceLocator->getServiceLocator();

        if ($services->has('ApplicationConfig')) {
            $config = $services->get('ApplicationConfig');
            if (isset($config['cache_dir']) && ! empty($config['cache_dir'])) {
                $configCacheDir = $config['cache_dir'];
            }
            if (isset($config['config_cache_key']) && ! empty($config['config_cache_key'])) {
                $configCacheKey = $config['config_cache_key'];
            }
        }

        return new DevelopmentModeViewHelper($configCacheDir, $configCacheKey);
    }
}
