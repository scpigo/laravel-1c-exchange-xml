<?php

namespace Scpigo\Laravel1cXml\Services\Impls\Sftp;

use Illuminate\Support\Facades\Storage;
use Scpigo\Laravel1cXml\Dto\XmlExchangeConfigDto;
use Scpigo\Laravel1cXml\Services\Impls\ExchangerAbstract;
use Scpigo\Laravel1cXml\Services\Interfaces\DownloadInterface;

class DownloadService extends ExchangerAbstract implements DownloadInterface {
    public function download() {
        $xml = Storage::disk('sftp')->get($this->config->server_path.$this->config->filename);

        if (Storage::disk($this->config->local_disk_driver)->put($this->config->local_path.$this->config->filename, $xml)) {
            return true;
        };

        return false;
    }
}