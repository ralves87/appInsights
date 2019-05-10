<?php

namespace MyProject\ApplicationInsights\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper {

    /**
     * Used to check if module is enabled.
     */
    const MODULE_ENABLED = 'applicationinsights/module/enabled';

    /**
     * Get azure instrumentation key.
     */
    const INSTRUMENTATION_KEY = 'applicationinsights/module/instrumentationkey';

    /**
     * Check if module is enable.
     *
     * @param null $storeId
     * @return bool
     */
    public function isEnabled($storeId = null)
    {
        return (bool) $this->getConfig(
            static::MODULE_ENABLED, 
            $storeId
        );
    }

    /**
     * Get Instrumental Key.
     *
     * @param int $storeId
     * @return string
     */
    public function getInstrumentalKey($storeId = null)
    {   
        return $this->getConfig(
            static::INSTRUMENTATION_KEY, 
            $storeId
        );
    }
    
     /**
     * Return store configuration value.
     *
     * @param string $path
     * @param int $storeId
     * @return mixed
     */
    public function getConfig($path, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
