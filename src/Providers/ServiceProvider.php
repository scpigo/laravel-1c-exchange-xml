<?php 

namespace Scpigo\Laravel1cXml\Providers;

use Scpigo\Laravel1cXml\Commands\ReadXML;
use Scpigo\Laravel1cXml\Commands\UploadXML;
use Scpigo\Laravel1cXml\Components\Impls\XmlExchanger;
use Scpigo\Laravel1cXml\Components\Interfaces\XmlExchangerInterface;
use Scpigo\Laravel1cXml\Jobs\ReadXmlJob;
use Scpigo\Laravel1cXml\Jobs\UploadXmlJob;
use Scpigo\Laravel1cXml\Services\Impls\Post\UploadService as RequestUploadService;
use Scpigo\Laravel1cXml\Services\Impls\Sftp\UploadService as SftpUploadService;
use Scpigo\Laravel1cXml\Drivers\Mongo\Services\ReadService as MongoReadService;

class ServiceProvider extends \Illuminate\Support\ServiceProvider { 
    public $bindings = [
        XmlExchangerInterface::class => XmlExchanger::class,

        '1C_UPLOAD_XML' => UploadXmlJob::class,
        '1C_READ_XML' => ReadXmlJob::class
    ];

    public function boot() { 
        if ($this->app->runningInConsole()) {
            $this->commands([
                UploadXML::class,
                ReadXML::class
            ]);
        }

        $this->mergeConfigFrom(__DIR__.'/../../config/1c.php', '1c');

        $this->publishes([
            __DIR__.'/../../config/1c.php' => config_path('1c.php'),
        ]);
    }

    public function register() 
    {
        $this->app->alias(RequestUploadService::class, 'post');
        $this->app->alias(SftpUploadService::class, 'sftp');

        $this->app->alias(MongoReadService::class, 'mongo');
    }
}