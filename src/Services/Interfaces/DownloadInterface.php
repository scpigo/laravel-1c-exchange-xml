<?php

namespace Scpigo\Laravel1cXml\Services\Interfaces;

interface DownloadInterface {
    public function download(
        string $local_disk_driver, 
        string $local_path,
        string $server_path,
        string $filename
    );
}