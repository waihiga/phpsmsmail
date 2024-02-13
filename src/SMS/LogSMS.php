<?php


namespace Waihiga\Phpsmsmail\SMS;


class LogSMS extends AbstractPhpSMS
{
    protected function doSend($phone_number, $message)
    {
        $number = is_string($phone_number) ? $phone_number : json_encode($phone_number);

        return $this->sendSms($number, $message);
    }
    public function sendSms($phone_number, $message)
    {
        \Log::info(
            "--------- Start SMS Message ----------- ".PHP_EOL.
            "TO: $phone_number ".PHP_EOL.
            "Message: $message".PHP_EOL.
            "--------- End SMS Message -------------- "
        );

        return true;
    }
}