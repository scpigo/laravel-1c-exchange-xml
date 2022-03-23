<?php

namespace Scpigo\Laravel1cXml\Services\Impls\Http;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Scpigo\Laravel1cXml\Services\Impls\ExchangerAbstract;
use Scpigo\Laravel1cXml\Services\Interfaces\DownloadInterface;

class DownloadService extends ExchangerAbstract implements DownloadInterface {
    public function download() {
        $xml = Http::get($this->config->server_path);

        if (Storage::disk($this->config->local_disk_driver)->put($this->config->local_path.$this->config->filename, $xml)) {
            return true;
        };

        return false;
    }
}