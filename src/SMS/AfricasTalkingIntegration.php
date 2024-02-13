<?php

namespace Waihiga\Phpsmsmail\SMS;

use GuzzleHttp\Client;

class AfricasTalkingIntegration extends AbstractPhpSMS
{
    public function __construct()
    {
        $this->key = config('phpsmsmail.sms.africastalking.api_key');
        $this->username = config('phpsmsmail.sms.africastalking.username');
        $sender = config('phpsmsmail.sms.africastalking.sender_id');
        !$sender ?: $this->sender = $sender;
    }

    public function sendSMS($phone_number, $message)
    {
        $client = new Client([
            'base_uri' => 'https://api.africastalking.com',
            'headers'  => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept'       => 'application/json',
                'apiKey'       => $this->key,
            ],
        ]);

        $data =  [
            'username' => $this->username,
            'message'  => $message,
            'to'       => $phone_number
        ];

        if($this->sender ){
            $data['from'] = $this->sender;
        }

        $resp = $client->post('version1/messaging', [
            'form_params' => $data
        ]);

        $body = json_decode($resp->getBody()->getContents(), true);

        $msg = $body['SMSMessageData']['Message'];

        if(starts_with($msg, 'Sent'))  {
            return true;
        }

        return false;
    }
}