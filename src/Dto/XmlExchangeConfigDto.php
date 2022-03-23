<?php

namespace Scpigo\Laravel1cXml\Dto;

class XmlExchangeConfigDto {
    public string $local_disk_driver = '';
    public string $local_path = '';

    public string $server_disk_driver = '';
    public string $server_path = '';
    public string $remote_url = '';

    public string $filename = '';

    public string $db_driver = '';
}