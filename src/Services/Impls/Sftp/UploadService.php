<?php

namespace Scpigo\Laravel1cXml\Services\Impls\Sftp;

use Illuminate\Support\Facades\Storage;
use Scpigo\Laravel1cXml\Dto\XmlExchangeConfigDto;
use Scpigo\Laravel1cXml\Services\Impls\ExchangerAbstract;
use Scpigo\Laravel1cXml\Services\Interfaces\UploadInterface;

class UploadService extends ExchangerAbstract implements UploadInterface {
    public function upload() {
        $xml = Storage::disk($this->config->local_disk_driver)->get($this->config->local_path.$this->config->filename);

        if (Storage::disk('sftp')->put($this->config->server_path.$this->config->filename, $xml)) {
            return true;
        };

        return false;
    }
}