<?php


use Illuminate\Support\ServiceProvider as PackageServiceProvider;
use Waihiga\Phpsmsmail\SMS\AfricasTalkingIntegration;
use Waihiga\Phpsmsmail\SMS\LogSMS;
use Waihiga\Phpsmsmail\SMS\PhpSMSInterface;

class ServiceProvider extends PackageServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/phpsmsmail.php' => config_path('phpsmsmail.php'),
        ]);
    }

    public function register()
    {
        $this->registerSMSIntegrationProviders();
    }

    protected function registerSMSIntegrationProviders()
    {
        $this->app->singleton('sms',  function() use ($sms){
            return $this->getClass();
        });

        $this->app->singleton(PhpSMSInterface::class,  function() use ($sms){
            return $sms;
        });
    }
    protected function getClass()
    {
        $provider = config('phpsmsmail.sms.default');

        switch ($provider) {
            case 'log':
                return new LogSMS();
            case 'africastalking':
            default:
                return new AfricasTalkingIntegration();
        }
    }
}