<?php

return [
    'default' => 'orders',

    'exchangers' => [
        'orders' => [
            'local_disk_driver' => 'local',
            'local_path' => '1c/',

            'server_disk_driver' => 'sftp',
            'server_path' => '1c/',

            'filename' => 'order.xml',
            
            'db_driver' => 'mongo',
        ],
    ]
];