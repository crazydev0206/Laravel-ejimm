<?php

namespace FleetCart\Console\Commands;

use Illuminate\Console\Command;
use FleetCart\Scaffold\Module\ModuleScaffold;
use Illuminate\Support\Facades\Log;

class ScaffoldModuleCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'scaffold:module';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold a new module';

    /**
     * The instance of ModuleScaffold.
     *
     * @var \FleetCart\Scaffold\Module\ModuleScaffold
     */
    private $scaffolder;

    /**
     * Create a new command instance.
     *
     * @param \FleetCart\Scaffold\Module\ModuleScaffold $scaffolder
     */
    public function __construct(ModuleScaffold $scaffolder)
    {
        parent::__construct();

        $this->scaffolder = $scaffolder;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $module = $this->askModuleName();
        $entities = $this->askEntities();

        $this->scaffolder->scaffold($module, $entities);

        $this->info('Module has been generated.');
    }

    /**
     * Ask for module name.
     *
     * @return array
     */
    private function askModuleName()
    {
        do {
            $moduleName = $this->ask('Please enter the module name in the following format: vendor/name');

            list($vendor, $name) = $this->extractModuleName($moduleName);
        } while ($this->moduleExists($name));

        return compact('vendor', 'name');
    }

    /**
     * Extract the given module name.
     *
     * @param string $moduleName
     * @return array
     */
    private function extractModuleName($moduleName)
    {
        do {
            $name = explode('/', $moduleName);

            if (count($name) !== 2) {
                $this->error('Module name must be in the following format: vendor/name');

                $moduleName = $this->ask('Please enter the module name in the following format: vendor/name');
            }
        } while (count($name) !== 2);

        return [$name[0], ucfirst(camel_case($name[1]))];
    }

    /**
     * Determine the given module is exists.
     *
     * @param string $name
     */
    private function moduleExists($name)
    {
        if (is_dir(config('modules.paths.modules') . "/{$name}")) {
            $this->error("The module [$name] is already exists.");

            return true;
        }

        return false;
    }

    /**
     * Ask for entities.
     *
     * @return array
     */
    private function askEntities()
    {
        $entities = [];

        do {
            $entity = $this->ask('Enter entity name. Leaving option empty will continue script', false);

            if ($entity !== '') {
                $entities[] = ucfirst($entity);
            }
        } while ($entity !== '');

        return $entities;
    }
}
