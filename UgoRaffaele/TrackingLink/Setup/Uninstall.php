<?php
namespace UgoRaffaele\TrackingLink\Setup;
use Magento\Framework\Setup\UninstallInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Config\Model\ResourceModel\Config\Data\CollectionFactory as ConfigCollectionFactory;

class Uninstall implements UninstallInterface
{

    private $configCollectionFactory;

    public function __construct(
		ConfigCollectionFactory $configCollectionFactory
	) {
        $this->configCollectionFactory = $configCollectionFactory;
    }
    
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $this->removeConfig();	
        $setup->endSetup();
    }

    private function removeConfig()
    {
        $path = 'trackinglink/service_url';
        /** @var \Magento\Config\Model\ResourceModel\Config\Data\Collection $collection */
        $collection = $this->configCollectionFactory->create(); 
        $collection->addPathFilter($path);

        foreach ($collection as $config) {
			$config->delete(); 	
        }
    }   
	
}