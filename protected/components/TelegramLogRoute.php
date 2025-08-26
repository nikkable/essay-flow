<?php

Yii::import('application.components.TelegramSender');

class TelegramLogRoute extends CLogRoute
{
    public $autoFlush = 1;

    protected function processLogs($logs)
    {
        foreach ($logs as $log) {
            if (strpos($log[2], '500') !== false) {
                $this->sendToTelegram($log);
            }
        }
    }

    public function collectLogs($logger, $processLogs = false)
    {
        // Получаем логи с учетом фильтров
        $logs = $logger->getLogs($this->levels, $this->categories, $this->except);

        if ($processLogs && !empty($logs)) {
            $this->processLogs($logs);
        }

        return $logs;
    }

    private function sendToTelegram($log)
    {
        $message = "Error Logged for " . Yii::app()->name . ":\n";
        $message .= "Message: " . $log[0] . "\n";
        $message .= "Level: " . $log[1] . "\n";
        $message .= "Category: " . $log[2] . "\n";
        $message .= "Time: " . date('Y-m-d H:i:s', $log[3]) . "\n";

        $telegram = new TelegramSender(Yii::app()->params['telegramLogsToken'], Yii::app()->params['telegramLogsChatId']);
        $telegram->sendMessage($message);
    }
}