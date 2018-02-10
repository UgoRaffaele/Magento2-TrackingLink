# Magento2-TrackingLink
TrackingLink adds custom link tag to the tracking code shown in transactional emails

## Installation

:warning: _Always backup your store before installing._

* Copy "UgoRaffaele" folder into <your Magento install dir>/app/code
* Open a terminal and move to Magento root directory
* Run these commands in your terminal

```shell
# You must be in Magento root directory
composer require ugoraffaele/module-tracking-link
php bin/magento cache:clean
php bin/magento module:enable UgoRaffaele_TrackingLink
php bin/magento setup:upgrade
```

* If you are logged to Magento backend, logout from Magento backend and login again

## License

[Open Software License v3.0](LICENSE.txt)

## Original Author

[Karliuka Vitalii](https://github.com/karliuka/m2.TrackingLink)