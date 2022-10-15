<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class remove extends Command
{

    private $fileNames = [
        'app/Models/CrudGenerator',
        'app/Http/Requests/StoreCrudGeneratorRequest',
        'app/Http/Requests/UpdateCrudGeneratorRequest',
        'app/Http/Controllers/CrudGeneratorController',
        'app/Repositories/CrudGeneratorRepository',
        'app/Services/CrudGeneratorService'
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:remove {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command is deleting crud';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach ($this->fileNames as $fileName) {
            echo "removing: " . str_replace('CrudGenerator', $this->argument('name'), $fileName) . '.php' . "\n";
            unlink(str_replace('CrudGenerator', $this->argument('name'), $fileName) . '.php');
        }
        die();
    }
}