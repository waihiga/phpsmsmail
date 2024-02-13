<?php


namespace Waihiga\Phpsmsmail\SMS;


use Illuminate\Support\Facades\Facade;

class SMS extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'sms';
    }
}