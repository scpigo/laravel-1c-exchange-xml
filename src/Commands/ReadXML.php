<?php

namespace Scpigo\Laravel1cXml\Commands;

use Scpigo\SystemJob\Helpers\SystemJobStatus;
use Illuminate\Console\Command;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Carbon;
use Scpigo\SystemJob\Dto\SystemJobSchedulerDto;
use Scpigo\SystemJob\Facades\SystemJobManagerFacade as SystemJobManager;

class ReadXML extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xml:read';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reads xml file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dto = new SystemJobSchedulerDto;

        $dto->action = '1C_READ_XML';
        $dto->scheduled_at =  Carbon::createFromFormat('Y-m-d H:i:s', gmdate(now()));

        $data = SystemJobManager::scheduler()->schedule($dto);

        if (!$data) {
            $this->error('При планировании произошла ошибка');

            return 0;
        }

        $this->info('Запланировано чтение XML файла');

        return 0;
    }
}
