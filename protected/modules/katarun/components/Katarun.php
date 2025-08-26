<?php

require_once '../protected/modules/katarun/vendor/autoload.php';

/**
 * Class for working with Katarun REST
 *
 * @package  yupe.modules.katarun.components
 * @author   Nikkable
 * @license
 **/
class Katarun
{
    // Payment key
    private $key;

    private $brand_id;
    private $api_key;
    private $endpoint;
    private $return_url;
    private $fail_url;

    public function __construct(Payment $payment)
    {
        $settings = $payment->getPaymentSystemSettings();

        $this->brand_id = $settings['brand_id'];
        $this->api_key = $settings['api_key'];
        $this->endpoint = $settings['endpoint'];
        $this->return_url = $settings['return_url'];
        $this->fail_url = $settings['fail_url'];
    }

    /**
     * Starts a payment session and returns its ID
     *
     * @param Order $order
     * @return string|bool
     */
    public function getFormUrl(Order $order)
    {

        $katarun = new Katarun\KatarunApi($this->brand_id,  $this->api_key, $this->endpoint);

        $client = new \Katarun\Model\ClientDetails();
        $client->email = $order->email;
        $client->full_name = $order->name;
        $client->street_address = $order->street;
        $client->country = $order->country;
        $client->city = $order->city;
        $client->zip_code = $order->zipcode;
        $client->state = $order->house;

        $purchase = new \Katarun\Model\Purchase();
        $purchase->client = $client;

        $details = new \Katarun\Model\PurchaseDetails();
        $product = new \Katarun\Model\Product();
        $product->name = 'Test';
        $product->quantity = 1;
        $product->price = (int)($order->getTotalPriceCurrency() * 100);

        $details->products = [$product];
        $details->currency = Yii::app()->controller->currency;
        $purchase->purchase = $details;
        $purchase->brand_id = $this->brand_id;
        $purchase->success_redirect = Yii::app()->createAbsoluteUrl('/payment/payment/process', ['id' => 1]) . '?orderId=' . $order->id;
        $purchase->failure_redirect = Yii::app()->createAbsoluteUrl('/payment/payment/process', ['id' => 1]) . '?orderId=' . $order->id;
        $purchase->cancel_redirect = Yii::app()->createAbsoluteUrl('/payment/payment/process', ['id' => 1]) . '?orderId=' . $order->id;

        try {
            $result = $katarun->createPurchase($purchase);
        } catch (Exception $e) {
            throw new CHttpException(500, 'Error payment url katarun order id ' . $order->id);
        }

        if ($result && $result->id) {
            $order->katarun_id = $result->id;
            $order->currency = Yii::app()->controller->currency;
            $order->coff = Yii::app()->controller->currencyCoff;
            $order->save();
        }

        if ($result && $result->checkout_url) {
            return $result->checkout_url;
        }

        return '';
    }

    /**
     * Gets the status of the current payment
     *
     * @param CHttpRequest $request
     * @param Order $order
     * @return string|bool
     */
    public function getPaymentStatus(CHttpRequest $request, Order $order)
    {
        try {
            $katarun = new \Katarun\KatarunApi($this->brand_id,  $this->api_key, $this->endpoint);
            $purchase = $katarun->getPurchase($order->katarun_id);

            if($purchase && $purchase->status === 'paid') {
                return true;
            }
        } catch (\Exception $exception) {}

        return false;
    }
}
