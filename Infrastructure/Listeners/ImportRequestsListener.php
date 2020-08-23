<?php

namespace Infrastructure\Listeners;

use Domain\Abstractions\CsvToArrayAbstract;
use Domain\Services\LogService;
use Illuminate\Database\Events\MigrationsEnded;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Infrastructure\Exceptions\ModelNotCreatedException;

/**
 * Class ImportRequestsListener
 * @package Infrastructure\Listeners
 */
class ImportRequestsListener extends CsvToArrayAbstract
{
    /**
     * @var LogService
     */
    protected $logService;

    /**
     * Create the event listener.
     *
     * @param LogService $logService
     */
    public function __construct(LogService $logService)
    {
        $this->logService   =   $logService;
    }

    /**
     * Handle the event.
     *
     * @param MigrationsEnded $event
     * @return void
     * @throws ModelNotCreatedException
     */
    public function handle(MigrationsEnded $event): void
    {
        if (!app()->runningUnitTests()) {
            $csvFile = storage_path('app/testdata.csv');

            // Run the migration if he logs table doesn't exisit
            if (!Schema::hasTable('logs')) {
                Artisan::call('migrate', ['--path' => 'Domain/database/migrations', '--force' => true]);
            }
            
            if (file_exists($csvFile)) {
                $result  = $this->readCSV($csvFile)->execute();
                if ($result->isNotEmpty()) {
                    foreach ($result->toArray() as $log) {
                        $this->logService->create($log);
                    }
                }
            }
        }
    }
}
