<?php

//sms and mails configuration file

return [
    'sms' =>[
        'default' => env('SMS_DRIVER', 'log'),
    ],

    'africastalking' => [
        'username' => env('AFRICASTALKING_USERNAME', ''),
        'api_key' => env('AFRICASTALKING_API_KEY'),
        'sender_id' =>env('AFRICASTALKING_SENDER_ID')
    ],
];