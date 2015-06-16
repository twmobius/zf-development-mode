<?php

namespace ZF\DevelopmentMode;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class DevelopmentModeControllerPlugin extends AbstractPlugin
{
    const CONFIG_CACHE_BASE = 'module-config-cache';

    /**
     * @param string Configuration cache directory, if any
     */
    private $configCacheDir;

    /**
     * @param string Configuration cache key, if any
     */
    private $configCacheKey;

    /**
     * @param null|string $configCacheDir
     * @param null|string $configCacheKey
     */
    public function __construct($configCacheDir, $configCacheKey)
    {
        $this->configCacheDir = $configCacheDir;
        $this->configCacheKey = $configCacheKey;
    }

    /**
     * Retrieve the config cache file, if any.
     *
     * @return false|string
     */
    private function getConfigCacheFile()
    {
        if (empty($this->configCacheDir)) {
            return false;
        }

        $path = sprintf('%s/%s.', $this->configCacheDir, self::CONFIG_CACHE_BASE);

        if (! empty($this->configCacheKey)) {
            $path .= $this->configCacheKey . '.';
        }

        return $path . 'php';
    }

    public function __invoke() {
	return (file_exists($this->getConfigCacheFile()));
    }
}
