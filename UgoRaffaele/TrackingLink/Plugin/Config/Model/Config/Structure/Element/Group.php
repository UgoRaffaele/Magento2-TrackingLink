<?php
namespace UgoRaffaele\TrackingLink\Plugin\Config\Model\Config\Structure\Element;
use Magento\Shipping\Model\Config as ShippingConfig;

class Group {

    protected $shippingConfig;

    public function __construct(
        ShippingConfig $shippingConfig
    ) {
        $this->shippingConfig = $shippingConfig;
    }
    
    public function beforeSetData($subject, array $data, $scope)
    {
		if($data['path'] == 'trackinglink' && $data['id'] == 'service_url') {
			foreach ($this->getTrackingCarriers() as $code => $title) {
				if (isset($data['children'][$code])) {
					continue;
				}
				$data['children'][$code] = $this->getFieldData($code, $title);
			}
		}
        return [$data, $scope];
    }
    
    protected function getFieldData($code, $title)
    {
        return [
			'id' => $code,
			'type' => 'text',
			'showInDefault' => '1',
			'showInWebsite' => '1',
			'showInStore' => '1',
			'label' => (string)__($title),
			'path' => 'trackinglink/service_url',
			'_elementType' => 'field'
		];
    }

    protected function getTrackingCarriers()
    {
        $carriers = [];
        foreach ($this->getAllCarriers() as $code => $carrier) {
            if ($carrier->isTrackingAvailable()) {
                $carriers[$code] = $carrier->getConfigData('title');
            }
        }
        return $carriers;
    }
    
    protected function getAllCarriers()
    {
        return $this->shippingConfig->getAllCarriers();
    }  
	
}