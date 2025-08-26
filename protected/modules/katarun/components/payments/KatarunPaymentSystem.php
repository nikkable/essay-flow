<?php

/**
 * Class KatarunPaymentSystem
 * @link
 */

use yupe\widgets\YFlashMessages;

Yii::import('application.modules.katarun.KatarunModule');
Yii::import('application.modules.katarun.components.Katarun');
/**
 * Class SberbankPaymentSystem
 */
class KatarunPaymentSystem extends PaymentSystem
{
    /**
     * @param Payment $payment
     * @param Order $order
     * @param bool|false $return
     * @return mixed|string
     */
    public function renderCheckoutForm(Payment $payment, Order $order, $return = false)
    {
        $sbank = new Katarun($payment);
        $action = $sbank->getFormUrl($order);

        if (!$action) {
            Yii::app()->getUser()->setFlash(
                YFlashMessages::ERROR_MESSAGE,
                Yii::t('KatarunModule.katarun', 'Payment by "{name}" is impossible', ['{name}' => $payment->name])
            );

            return false;
        }

        return Yii::app()->getController()->renderPartial('application.modules.katarun.views.form', [
            'action' => $action
        ], $return);
    }

    /**
     * @param Payment $payment
     * @param CHttpRequest $request
     * @return bool
     */
    public function processCheckout(Payment $payment, CHttpRequest $request)
    {
        $orderId = $request->getParam('orderId');
        $katarun = new Katarun($payment);
        $order = Order::model()->findByAttributes(['id' => $orderId]);

        if ($order === null) {
            Yii::log(Yii::t('KatarunModule.katarun', 'The order doesn\'t exist.'), CLogger::LEVEL_ERROR);
            return false;
        }

        if ($order->isPaid()) {
            Yii::log(
                Yii::t('KatarunModule.katarun', 'The order #{n} is already payed.', $order->getPrimaryKey()),
                CLogger::LEVEL_ERROR
            );

            return $order;
        }

        if ($katarun->getPaymentStatus($request, $order) && $order->pay($payment)) {
            Yii::log(
                Yii::t('KatarunModule.katarun', 'The order #{n} has been payed successfully.', $order->getPrimaryKey()),
                CLogger::LEVEL_INFO
            );
            Yii::app()->getUser()->setFlash(
                YFlashMessages::SUCCESS_MESSAGE,
                Yii::t('KatarunModule.katarun', 'The order #{n} has been payed successfully.', $order->getPrimaryKey())
            );
        } else {
            $order->unpay($payment);

            Yii::app()->getUser()->setFlash(
                YFlashMessages::ERROR_MESSAGE,
                Yii::t('KatarunModule.katarun', 'Attempt to pay failed')
            );
            Yii::log(Yii::t('KatarunModule.katarun', 'An error occurred when you pay the order #{n}.',
                $order->getPrimaryKey()), CLogger::LEVEL_ERROR);
        }

        return $order;

    }
}
