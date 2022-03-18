<?php

namespace Scpigo\Laravel1cXml\Jobs;

use Scpigo\SystemJob\Jobs\SystemJobAbstract;
use Scpigo\Laravel1cXml\Helpers\XmlExchangeManager;

class DownloadXmlJob extends SystemJobAbstract
{
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $manager = new XmlExchangeManager;

        $manager->exchanger('orders')->download();
    }
}