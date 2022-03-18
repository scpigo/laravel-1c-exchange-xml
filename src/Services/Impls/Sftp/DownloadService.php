<?php

namespace Scpigo\Laravel1cXml\Services\Impls\Sftp;

use Illuminate\Support\Facades\Storage;
use Scpigo\Laravel1cXml\Services\Interfaces\DownloadInterface;

class DownloadService implements DownloadInterface {
    public function download(
        string $local_disk_driver, 
        string $local_path,
        string $server_path,
        string $filename
    ) {
        $xml = Storage::disk('sftp')->get($server_path.$filename);

        if (Storage::disk($local_disk_driver)->put($local_path.$filename, $xml)) {
            return true;
        };

        return false;
    }
}