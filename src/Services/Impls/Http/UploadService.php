<?php

namespace Scpigo\Laravel1cXml\Services\Impls\Http;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Scpigo\Laravel1cXml\Services\Impls\ExchangerAbstract;
use Scpigo\Laravel1cXml\Services\Interfaces\UploadInterface;

class UploadService extends ExchangerAbstract implements UploadInterface {
    public function upload() {
        $xml = Storage::disk($this->config->local_disk_driver)->get($this->config->local_path.$this->config->filename);

        $response = Http::post($this->config->server_path, $xml);

        if ($response->failed()) {
            return false;
        };

        return true;
    }
}