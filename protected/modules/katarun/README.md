# Katarun PHP library #

## Requirements ##

PHP 7.2 and later.

The following PHP extensions are required:

* curl
* json
* openssl

## Installation ##

## Composer ##

```bash
composer install
```

## Getting Started ##

Simple usage looks like:


```php
<?php
require_once 'vendor/autoload.php';
$katarun = new \Katarun\KatarunApi($config['brand_id'], $config['api_key'], $config['endpoint']);
$client = new \Katarun\Model\ClientDetails();
$client->email = 'test@example.com';
$purchase = new \Katarun\Model\Purchase();
$purchase->client = $client;
$details = new \Katarun\Model\PurchaseDetails();
$product = new \Katarun\Model\Product();
$product->name = 'Test';
$product->price = 100;
$details->products = [$product];
$purchase->purchase = $details;
$purchase->brand_id = $config['brand_id'];
$purchase->success_redirect = 'https://gate.katarun.com/api/v1/?success=1';
$purchase->failure_redirect = 'https://gate.katarun.com/api/v1/?success=0';

$result = $katarun->createPurchase($purchase);

if ($result && $result->checkout_url) {
	// Redirect user to checkout
	header("Location: " . $result->checkout_url);
	exit;
}
```

## Testing ##

```bash
./vendor/bin/phpunit tests 
```