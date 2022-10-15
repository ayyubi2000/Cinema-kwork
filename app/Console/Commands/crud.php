<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class crud extends Command
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
    protected $signature = 'make:crud {name} {--path=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'successful';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path = $this->option('path') ?? strtolower($this->argument('name'));

        foreach ($this->fileNames as $fileName) {
            echo "Creating: " . str_replace('CrudGenerator', $this->argument('name'), $fileName) . '.php' . "\n";
            $content = file_get_contents($fileName . '.php');
            $content = str_replace(['CrudGenerator', 'crudgenerators', 'crudgenerator_id'], [$this->argument('name'), $path, strtolower($this->argument('name')) . '_id'], $content);
            file_put_contents(str_replace('CrudGenerator', $this->argument('name'), $fileName) . '.php', $content);
        }

        Artisan::call('make:migration create_' . strtolower($this->argument('name')) . '_table');
    }
}