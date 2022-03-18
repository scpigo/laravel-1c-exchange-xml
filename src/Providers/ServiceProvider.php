<?php 

namespace Scpigo\Laravel1cXml\Providers;

use Scpigo\Laravel1cXml\Commands\WriteDB;
use Scpigo\Laravel1cXml\Commands\DownloadXML;
use Scpigo\Laravel1cXml\Commands\UploadXML;
use Scpigo\Laravel1cXml\Components\Impls\XmlExchanger;
use Scpigo\Laravel1cXml\Components\Interfaces\XmlExchangerInterface;
use Scpigo\Laravel1cXml\Jobs\WriteDBJob;
use Scpigo\Laravel1cXml\Jobs\DownloadXmlJob;
use Scpigo\Laravel1cXml\Jobs\UploadXmlJob;

use Scpigo\Laravel1cXml\Services\Impls\Post\DownloadService as RequestDownloadService;
use Scpigo\Laravel1cXml\Services\Impls\Sftp\DownloadService as SftpDownloadService;
use Scpigo\Laravel1cXml\Services\Impls\Post\UploadService as RequestUploadService;
use Scpigo\Laravel1cXml\Services\Impls\Sftp\UploadService as SftpUploadService;

use Scpigo\Laravel1cXml\Drivers\Mongo\Services\WriteService as MongoWriteService;

class ServiceProvider extends \Illuminate\Support\ServiceProvider { 
    public $bindings = [
        XmlExchangerInterface::class => XmlExchanger::class,

        '1C_XML_DOWNLOAD' => DownloadXmlJob::class,
        '1C_XML_UPLOAD' => UploadXmlJob::class,
        '1C_XML_WRITE_DB' => WriteDBJob::class
    ];

    public function boot() { 
        if ($this->app->runningInConsole()) {
            $this->commands([
                DownloadXML::class,
                UploadXML::class,
                WriteDB::class,
            ]);
        }

        $this->mergeConfigFrom(__DIR__.'/../../config/1c.php', '1c');

        $this->publishes([
            __DIR__.'/../../config/1c.php' => config_path('1c.php'),
        ]);
    }

    public function register() 
    {
        $this->app->alias(RequestDownloadService::class, 'download_post');
        $this->app->alias(SftpDownloadService::class, 'download_sftp');

        $this->app->alias(RequestUploadService::class, 'upload_post');
        $this->app->alias(SftpUploadService::class, 'upload_sftp');

        $this->app->alias(MongoWriteService::class, 'mongo');
    }
}