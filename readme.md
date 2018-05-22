InterSales Piwik
===================
Adds Piwik tracking to Magento 1 store.
Note: You need a working Piwik installation (not provided with this extension).

Website: https://www.intersales.de/magento-extensions/piwik-magento1.html

Documentation: https://www.intersales.de/fileadmin/usr/website/magento-extensions/piwik-doku_de.pdf

Requirements
------------
- Magento >= 1.3
- PHP >= 5.5.0

Installation
------------

Upload the complete directory to your Magento server.
In order to install it you have two options:
1) modman
2) manual

If you use modman move the folder to the directory 

.modman 

Then issue this command from the root directory of your Magento installation:

$ modman deploy Piwik

If you prefer to install the extension manually just move the folder into the Magento root directory.
Note: no Magento files will be overwritten.
Note: please set the correct file and directory permissions.

Usage
-------

The extension is configured in System > Configuration > interSales AG Module > Piwik.

Preparing Piwik

In order to integrate Piwik tracking in Magento correctly Piwik has to be prepared first: your Piwik installation has to be correctly configured for the shop site and you will need the Piwik server url together with the  Piwik site id:
- In the Piwik configuration for the shop site the option „ECommerce“ must be activated in order for Ecommerce transactions (product views, carts and checkouts) to be tracked.
- The appropriate Piwik Site ID is stored in the settings for the web site / shop site within Piwik.

Activate Tracking 

After installation the extension is deactivated by default, so no tracking will take place.

Activate the extension by setting Activated to Yes.
 
Then enter the Piwik settings you prepared beforehand:
Piwik Site ID = id issued by Piwik for the shop site (see above)
Relative Piwik URL = URL of your Piwik server. Important: you must omit „http“ bzw. „https“ from the URL. Example: 
//my-piwik-server.com/

After entering the configuration parameters save the configuration, clear the Magento cache and recompile.

Check if everything went well by looking for the Piwik code in your html sourcecode. 

Support
-------
If you have any issues with this extension, open an issue on GitHub (see URL above)


Contribution
------------
Any contributions are highly appreciated. The best way to contribute code is to open a
[pull request on GitHub](https://help.github.com/articles/using-pull-requests).


Developer
---------
InterSales Team
* Website: [https://www.intersales.de](http://www.intersales.de)
* Twitter: [@intersales](https://twitter.com/intersales)


Copyright
---------
(c) 2014 - 2018 interSales AG Internet Commerce, Köln