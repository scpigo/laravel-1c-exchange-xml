<?php

namespace Scpigo\Laravel1cXml\Services\Interfaces;

interface UploadInterface {
    public function upload(
        string $local_disk_driver, 
        string $local_path,
        string $server_path,
        string $filename
    );
}