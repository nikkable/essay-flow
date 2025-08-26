<?php

class Telegram
{
    public $token = '7255781798:AAGjVGTsWYn3dybnL9e9IbcdrEMX9RNMAr8';
    public $chatId = '-1002251539005';

    public function __construct($token = null, $chatId = null)
    {
        if($token) $this->token = $token;
        if($chatId) $this->chatId = $chatId;
    }

    public function send($message)
    {
        $telegramApiUrl = 'https://api.telegram.org/bot'.$this->token.'/sendMessage';

        $telegramPostData = [
            "chat_id" => $this->chatId,
            "text" => strip_tags($message),
            "parse_mode" => "HTML",
        ];

        $telegramCh = curl_init($telegramApiUrl);
        curl_setopt($telegramCh, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($telegramCh, CURLOPT_POSTFIELDS, $telegramPostData);

        $telegramResponse = curl_exec($telegramCh);
        curl_close($telegramCh);
    }
}
