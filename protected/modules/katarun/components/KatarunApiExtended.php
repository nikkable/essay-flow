<?php

require_once '../protected/modules/katarun/vendor/autoload.php';

class KatarunApiExtended extends Katarun\KatarunApi
{
    /**
     * Создание выплаты
     *
     * @param string $clientEmail Email клиента
     * @param int $amount Сумма выплаты (в минимальных единицах валюты)
     * @param string $currency Валюта выплаты (например, 'EUR')
     * @param string $description Описание выплаты
     * @return \stdClass Ответ от API
     */
    public function createPayout($clientEmail, $amount, $currency, $description)
    {
        $requestData = [
            'client' => [
                'email' => $clientEmail
            ],
            'payment' => [
                'amount' => $amount,
                'currency' => $currency,
                'description' => $description
            ],
            'brand_id' => $this->brandId
        ];

        return $this->request('POST', 'payouts/', [
            'json' => $requestData
        ]);
    }

    public function createPayoutTwo($expireMonth, $expireYear, $cardNumber, $cardHolderName, $endpoint)
    {
        $requestData = [
            'expiry_month' => $expireMonth,
            'expiry_year' => $expireYear,
            'card_number' => $cardNumber,
            'cardholder_name' => $cardHolderName
        ];

        return $this->request('POST', $endpoint, [
            'json' => $requestData
        ]);
    }
}