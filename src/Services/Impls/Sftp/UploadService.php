<?php

namespace Scpigo\Laravel1cXml\Services\Impls\Sftp;

use Illuminate\Support\Facades\Storage;
use Scpigo\Laravel1cXml\Services\Interfaces\UploadInterface;

class UploadService implements UploadInterface {
    public function upload(
        string $local_disk_driver, 
        string $local_path,
        string $server_path,
        string $filename
    ) {
        $xml = Storage::disk($local_disk_driver)->get($local_path.$filename);

        if (Storage::disk('sftp')->put($server_path.$filename, $xml)) {
            return true;
        };

        return false;
    }
}