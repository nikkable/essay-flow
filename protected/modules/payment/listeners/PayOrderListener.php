<?php
Yii::import('application.components.Telegram');

class PayOrderListener
{
    public static function onSuccessPay(PayOrderEvent $event)
    {
        $order = $event->getOrder();

        $order->refresh();

        $module = Yii::app()->getModule('order');

        $from = $module->notifyEmailFrom ? : Yii::app()->getModule('yupe')->email;

        //администратору
        $to = $module->getNotifyTo();

        $body = Yii::app()->getController()->renderPartial('//payment/email/newOrderAdmin', ['order' => $order], true);

        foreach ($to as $email) {
            $email = trim($email);
            if ($email) {
                Yii::app()->mail->send(
                    $from,
                    $email,
                    Yii::t(
                        'OrderModule.order',
                        'New order #{n} on "{site}" .',
                        ['{n}' => $order->id, '{site}' => Yii::app()->getModule('yupe')->siteName]
                    ),
                    $body
                );
                Yii::app()->mail->reset();
            }
        }

        $message = "Новый заказ c ID: " . $order->id . "\n";
        $message .= "Сумма заказа: " . $order->getTotalPriceCurrency() . "\n";
        $message .= "Валюта заказа: " . Yii::app()->controller->currency . "\n";
        $message .= "Перейти к заказу: " . Yii::app()->createAbsoluteUrl('/order/order/view', ['url' => $order->url]) . "\n";
        $message .= "Статус оплаты: Успех \n";
        $message .= "Чек оплаты: " . Yii::app()->createAbsoluteUrl('/order/order/invoice', ['url' => $order->url]);

        $telegram = new Telegram();
        $telegram->send($message);

        //пользователю
        $to = $order->email;

        $body = Yii::app()->getController()->renderPartial('//payment/email/newOrderUser', ['order' => $order], true);

        Yii::app()->mail->send(
            $from,
            $to,
            Yii::t(
                'OrderModule.order',
                'Your order #{n} on "{site}" .',
                ['{n}' => $order->orderNumber, '{site}' => Yii::app()->getModule('yupe')->siteName]
            ),
            $body
        );
    }

    public static function onFailurePay(PayOrderEvent $event)
    {
        $order = $event->getOrder();
        $order->refresh();

        $message = "Заказ c ID: " . $order->id . "\n";
        $message .= "Сумма заказа: " . $order->getTotalPriceCurrency() . "\n";
        $message .= "Перейти к заказу: " . Yii::app()->createAbsoluteUrl('/order/order/view', ['url' => $order->url]) . "\n";
        $message .= "Статус оплаты: Ошибка";

        $telegram = new Telegram();
        $telegram->send($message);
    }
} 
