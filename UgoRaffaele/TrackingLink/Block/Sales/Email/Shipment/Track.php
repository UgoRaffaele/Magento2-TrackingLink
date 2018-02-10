<?php
namespace UgoRaffaele\TrackingLink\Block\Sales\Email\Shipment;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use UgoRaffaele\TrackingLink\Helper\Data as TrackingLinkHelper;

class Track extends Template {

    protected $helper;
	
    public function __construct(
        TrackingLinkHelper $helper,
        Context $context, 
        array $data = []
    ) {
        $this->helper = $helper;
        parent::__construct(
            $context,
            $data
        );
    }
	
    public function getTrackingUrl($track)
	{
        $url = $this->helper->getCarrierUrl(
            $track->getCarrierCode()
        );
        return $url ? str_replace('{{number}}', $track->getNumber(), $url) : null;
    }
	
}