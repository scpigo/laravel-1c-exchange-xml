<?php

namespace Scpigo\Laravel1cXml\Services\Interfaces;

interface ReadInterface {
    public function read(
        string $local_disk_driver, 
        string $local_path,
        string $filename
    );
}