<?php


namespace Waihiga\Phpsmsmail\SMS;


interface PhpSMSInterface
{
    public function send($contact,$message);
}