 # Installation of UniversalPay Plugin for Zencart

## Introduction
This manual is for the installation, configuration and the use of the payment module for Zencart and UniversalPay Gateway. 

System requirements:
*   PHP 7.3 or greater, refer to https://www.php.net/downloads.php 
*	Download Zencart from https://www.zen-cart.com/content.php?19-download and install it
* 	MySQL 5.7.8+ or greater (or MariaDB 10.2.7 or greater)
* 	UniversalPay Payments Merchant ID / password
* 	UniversalPay Payments plugin distribution package

Before we dive into installation part, we have the below assumptions:
* You have installed PHP and Zencart correctly
* You have Zencart administrator login details

Notes: 
* We recommend before getting started you take a full backup of your website.
* Installation & screenshots are based on Zencart 1.5.7c version

## Installation & Configuration
1. Put the files for the plugin in the required directories
1.1. "includes\languages\english\modules\payment\universalpay.php" in directory "includes\languages\english\modules\payment"
1.2. "includes\modules\payment\universalpay" & "includes\modules\payment\universalpay.php" in directory "includes\modules\payment"
1.3. "universalpay_main_handler.php" in the root directory of ZenCart

2.	Once in place you should see the UniversalPay available in Modules -> Payment.
![install2](https://github.com/learyeoin/media/blob/master/ZencartInstall1.PNG)
3.	Then click "Install Module". On the configuration page you will see the following form fields which must be populated. Please enter them with below values and click ‘Update’ button.
![install3](https://github.com/learyeoin/media/blob/master/ZenInstall2.PNG)
### Integration Options Panel
* Iframe/Standalone/hostedPayPage Displat Mode: there are three options to choose: Iframe,Standalone or hostedPayPage.
* Sandbox mode: enable the ‘YES’ for sandbox, otherwise, the ‘NO’ for live.
* Authorization Type: enable the ‘Capture’ for supporting immediate capturing of teh transaction, otherwise, the ‘Authorize’ to Authorize a transaction and manually capture at a later time yourself.
### UniversalPay Settings
* Merchant ID: replace with your merchant ID, should be several digits e.g. 666888
* Merchant Password: replace with your API password, should be several digits e.g. 1234
* Merchant Brand ID: replace with your brand ID, should be several digits e.g. 222
![configure1](https://github.com/learyeoin/media/blob/master/ZenInstall2.PNG)
## Refunds
To carry out a refund is simple.
1.	Just go to the Orders > Orders, it will show all the finished order lists.
![refunds1](https://user-images.githubusercontent.com/20408449/64270050-d3c92500-cf32-11e9-9a6a-e86d9775fe01.png)
2.	Click on the order which you want to make the refund, then it goes to the order detail page.
![refunds2](https://user-images.githubusercontent.com/20408449/64270153-ffe4a600-cf32-11e9-8cea-6b7d1ba7f09e.png)
3.	Scroll to the ‘ORDERS FROM PAYMENT GATEWAY’ panel, input amount to be refunded, then click on the button ‘MAKE REFUND’.
![refunds3](https://user-images.githubusercontent.com/20408449/64270251-26a2dc80-cf33-11e9-853b-0a8fb1506dea.png)
4.	You will see the green ‘Order refunded’ message. This can be verified in the merchant's back office tool as well.
![refunds4](https://user-images.githubusercontent.com/20408449/64270341-4c2fe600-cf33-11e9-9439-8172459ab044.png)

## Security
1. Do I need to use SSL/TLS on my payment pages?

Yes, for a couple of reasons:
* It's more secure. In particular, it significantly reduces your risk of being exposed to a man-in-the-middle attack.
* Users correctly feel more comfortable sharing their payment information on pages visibly served over HTTPS. Your conversion rate is likely to be higher if your pages are served over SSL/TLS, too.

2. What if I don't want to set up SSL/TLS yet?
* You can test your page--but not live transactions--before installing your SSL/TLS certificate. You don't need to enable HTTPS until you're ready to go live.
* To test live transactions without your own SSL/TLS certificate, you could host your site with a provider that provides a secure subdomain.
