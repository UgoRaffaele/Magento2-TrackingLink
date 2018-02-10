<?php
namespace UgoRaffaele\TrackingLink\Helper;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper {

    public function getCarrierUrl($carrierCode, $store = null)
    {
        return $this->getConfig("trackinglink/service_url/{$carrierCode}", $store);
    }
    
    protected function getConfig($path, $store = null)
    {
        return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE, $store);
    }
	
}