<?php


namespace Waihiga\Phpsmsmail\SMS;


use Illuminate\Support\Facades\Facade;

class SMS extends Facade
{
    /**
     * Class SMS
     * @package Waihiga\Phpsmsmail\SMS
     * @method send($number, $message)
     */
    public static function getFacadeAccessor()
    {
        return 'sms';
    }
}