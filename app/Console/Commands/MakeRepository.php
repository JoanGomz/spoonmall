<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create contract and repository for a model';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $interfaceName = $name . 'RepositoryInterface';
        $repositoryName = $name . 'Repository';

        $contractPath = app_path("Repositories/Contracts/{$interfaceName}.php");
        $repositoryPath = app_path("Repositories/{$repositoryName}.php");

        // Crear directorio si no existe
        if (!File::exists(app_path('Repositories/Contracts'))) {
            File::makeDirectory(app_path('Repositories/Contracts'), 0755, true);
        }

        if (!File::exists(app_path('Repositories'))) {
            File::makeDirectory(app_path('Repositories'), 0755, true);
        }

        // Crear el contrato
        $contractTemplate = "<?php

        namespace App\Repositories\Contracts;

        interface {$interfaceName}
        {
            public function getAll();
            public function find(\$id);
            public function create(array \$data);
            public function update(\$id, array \$data);
            public function delete(\$id);
        }";

        File::put($contractPath, $contractTemplate);


        $repositoryTemplate = "<?php

        namespace App\Repositories;

        use App\Repositories\Contracts\\{$interfaceName};

        class {$repositoryName} implements {$interfaceName}
        {
            public function getAll()
            {
                // TODO: Implement getAll() method.
            }

            public function find(\$id)
            {
                // TODO: Implement find() method.
            }

            public function create(array \$data)
            {
                // TODO: Implement create() method.
            }

            public function update(\$id, array \$data)
            {
                // TODO: Implement update() method.
            }

            public function delete(\$id)
            {
                // TODO: Implement delete() method.
            }
        }";
        File::put($repositoryPath, $repositoryTemplate);

        $this->info("Contract {$interfaceName} and repository {$repositoryName} correctly created.");
    }
}
