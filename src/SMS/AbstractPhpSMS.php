<?php


namespace Waihiga\Phpsmsmail\SMS;



abstract class AbstractPhpSMS implements PhpSMSInterface
{
    protected $sender;
    protected $key = '';
    protected $username = '';
    /**
     * Try sending a message, if it fails queue it
     * @param $phone_number
     * @param $message
     * @return array|bool
     */

    /**
     * Select a sender, if there's possibility of more than one possible sender IDs or names
     * @param string $sender
     * @return AbstractPhpSMS
     */
    public function setSender(string $sender)
    {
        $this->sender = $sender;

        return $this;
    }

    public function from($sender)
    {
        return $this->setSender($sender);
    }

    public function send($phone_number, $message)
    {
        try {
            return $this->doSend($phone_number, $message);
        } catch (\Exception $exception) {
//            $this->queue($phone_number, $message);

            return true;
        }
    }

    protected function doSend($phone_number, $message){
        $an_array = is_array($phone_number);

        if(!$an_array){
            return $this->sendSms($phone_number, $message);
        }

        $ret = [];
        foreach ($phone_number as $number) {
            $ret[] = $this->sendSms($number, $message);
        }

        return $ret;
    }

    abstract public function sendSms($phone_number, $message);
}