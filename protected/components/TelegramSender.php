<?php

class TelegramSender
{
    private $token;
    private $chatId;
    private $apiBaseUrl = 'https://api.telegram.org/bot';

    /**
     * @throws InvalidArgumentException If token or chat ID is empty
     */
    public function __construct(string $token, string $chatId)
    {
        if (empty($token)) {
            throw new InvalidArgumentException('Telegram token cannot be empty');
        }

        if (empty($chatId)) {
            throw new InvalidArgumentException('Chat ID cannot be empty');
        }

        $this->token = $token;
        $this->chatId = $chatId;
    }

    /**
     * Send message to Telegram chat
     *
     * @param string $message Message to send
     * @param string $parseMode Parse mode (HTML or Markdown)
     * @return array Telegram API response
     * @throws RuntimeException If the request fails
     */
    public function sendMessage(string $message, string $parseMode = 'HTML'): array
    {
        if (empty($message)) {
            throw new InvalidArgumentException('Message cannot be empty');
        }

        $url = $this->apiBaseUrl . $this->token . '/sendMessage';

        $postData = [
            'chat_id' => $this->chatId,
            'text' => strip_tags($message), // Still strip tags even for HTML mode for safety
            'parse_mode' => in_array($parseMode, ['HTML', 'MarkdownV2']) ? $parseMode : 'HTML',
        ];

        $ch = curl_init($url);

        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_HTTPHEADER => ['Content-Type: multipart/form-data'],
            CURLOPT_SSL_VERIFYPEER => true,
        ];

        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new RuntimeException('Telegram API request failed: ' . $error);
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            throw new RuntimeException('Telegram API returned HTTP code ' . $httpCode);
        }

        $decodedResponse = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException('Failed to decode Telegram API response');
        }

        return $decodedResponse;
    }
}