# eazypay
Eazypay payment integration for Laravel 5.*

## Installation

First, you'll need to install the package via Composer:

```shell
$ composer require bhavinjr/eazypay
```

Then, update `config/app.php` by adding an entry for the service provider.


```php
'providers' => [
    // ...
    Bhavinjr\Eazypay\Providers\EazypayServiceProvider::class,
];
```

Finally, from the command line again, publish the default configuration file:
```shell
php artisan vendor:publish --tag=config
```

## Usage


```php
use Bhavinjr\Eazypay\Eazypay;

class PaymentController extends Controller
{
   
    public function payment()
    {
    	$amount 		= 	10;
    	$refrenceNo 	= 	1; //stands for order id or any other related to database table
    	$optionalField 	=  '10|10|10|10'; (optional) //must be pass in pipe delimeter based on icici eazypay payment integration kit

        $eazypay 	= new Eazypay();
        $paymentUrl = $eazypay->getPaymentUrl($amount,$refrenceNo,$optionalField);
        return redirect()->to($paymentUrl); //it will redirect to your payment gateway site
    }

}
```

## Configuration

Configuration was designed to be as flexible.
global configuration can be set in the `app/config/eazypay.php` file.

make sure you have all the detail which needs to use in configuration file.
must read `app/config/eazypay.php` file.

<?php

return [

    'merchant_id'       =>  env('EAZYPAY_MERCHANT_ID'),
    'encryption_key'    =>  env('EAZYPAY_ENCRYPTION_KEY'),
    'return_url'        =>  env('EAZYPAY_RETURN_URL'),
    'sub_merchant_id'   =>  env('EAZYPAY_MERCHANT_ID'),
    'merchant_reference_no'      =>  env('EAZYPAY_MERCHANT_ID'),     
    'paymode'           =>  env('EAZYPAY_PAYMODE',9),

];