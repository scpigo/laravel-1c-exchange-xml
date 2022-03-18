<?php

namespace Scpigo\Laravel1cXml\Services\Interfaces;

interface WriteInterface {
    public function write(
        string $local_disk_driver, 
        string $local_path,
        string $filename
    );
}