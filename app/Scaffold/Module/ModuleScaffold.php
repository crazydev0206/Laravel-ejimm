<?php

namespace FleetCart\Scaffold\Module;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;
use FleetCart\Scaffold\Module\Generators\FilesGenerator;
use FleetCart\Scaffold\Module\Generators\EntityGenerator;

class ModuleScaffold
{
    /**
     * The vendor name of the module.
     *
     * @var string
     */
    protected $vendor;

    /**
     * The module name which will be generated.
     *
     * @var string
     */
    protected $name;

    /**
     * The instance of Filesystem.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    private $finder;

    /**
     * The instance of EntityGenerator.
     *
     * @var \FleetCart\Scaffold\Module\Generators\EntityGenerator
     */
    private $entityGenerator;

    /**
     * The instance of FilesGenerator.
     *
     * @var \FleetCart\Scaffold\Module\Generators\FilesGenerator
     */
    private $filesGenerator;

    /**
     * Array of files to be generated.
     *
     * @var array
     */
    protected $files = [
        'config/assets.stub' => 'Config/assets.php',
        'config/permissions.stub' => 'Config/permissions.php',
        'routes/routes.stub' => 'Routes/admin.php',
    ];

    /**
     * Create a new instance.
     *
     * @param \Illuminate\Filesystem\Filesystem $finder
     * @param \FleetCart\Scaffold\Module\Generators\EntityGenerator $entityGenerator
     * @param \FleetCart\Scaffold\Module\Generators\FilesGenerator $filesGenerator
     */
    public function __construct(Filesystem $finder, EntityGenerator $entityGenerator, FilesGenerator $filesGenerator)
    {
        $this->finder = $finder;
        $this->entityGenerator = $entityGenerator;
        $this->filesGenerator = $filesGenerator;
    }

    /**
     * @param array $module
     * @param array $entities
     * @return void
     */
    public function scaffold(array $module, array $entities)
    {
        $this->vendor = $module['vendor'];
        $this->name = $module['name'];

        Artisan::call('module:make', ['name' => [$this->name]]);

        $this->addFolders();
        $this->removeUnneededFiles();
        $this->addDataToComposerJsonFile();

        $this->filesGenerator->module($this->name)
            ->generateModuleProvider()
            ->generate($this->files);

        $this->addDataToModuleJson();
        $this->cleanupModuleJsonFile();

        $this->entityGenerator->module($this->getName())->generate($entities);
    }

    /**
     * Get studly cased module name.
     *
     * @return string
     */
    public function getName()
    {
        return studly_case($this->name);
    }

    /**
     * Get the path on the module.
     *
     * @return string
     */
    private function getModulesPath($path = '')
    {
        return config('modules.paths.modules') . "/{$this->getName()}/{$path}";
    }

    /**
     * Get the paths on the module.
     *
     * @param array $paths
     * @return array
     */
    private function getModulesPaths(array $paths)
    {
        $list = [];

        foreach ($paths as $path) {
            $list[] = $this->getModulesPath($path);
        }

        return $list;
    }

    /**
     * Remove vendor name from composer.json file.
     *
     * @return void
     */
    private function renameVendorName()
    {
        $composerJsonContent = $this->finder->get($this->getModulesPath('composer.json'));
        $composerJsonContent = str_replace('nwidart', $this->vendor, $composerJsonContent);

        $this->finder->put($this->getModulesPath('composer.json'), $composerJsonContent);
    }

    /**
     * Remove view files.
     *
     * @return void
     */
    private function removeViewFiles()
    {
        $this->finder->delete($this->getModulesPath('Resources/views/index.blade.php'));
        $this->finder->delete($this->getModulesPath('Resources/views/layouts/master.blade.php'));
        $this->finder->deleteDirectory($this->getModulesPath('Resources/views/layouts'));
    }

    /**
     * Add required folders.
     *
     * @return void
     */
    private function addFolders()
    {
        $this->finder->makeDirectory($this->getModulesPath('Sidebar'));
    }

    /**
     * Remove unneeded files and folders.
     *
     * @return void
     */
    private function removeUnneededFiles()
    {
        $this->renameVendorName();
        $this->removeViewFiles();

        $this->finder->deleteDirectory($this->getModulesPath('Database/factories'));
        $this->finder->deleteDirectory($this->getModulesPath('Database/Seeders'));
        $this->finder->deleteDirectory($this->getModulesPath('Events'));
        $this->finder->deleteDirectory($this->getModulesPath('Console'));
        $this->finder->deleteDirectory($this->getModulesPath('Http/Middleware'));
        $this->finder->deleteDirectory($this->getModulesPath('Jobs'));
        $this->finder->deleteDirectory($this->getModulesPath('Mail'));
        $this->finder->deleteDirectory($this->getModulesPath('Resources/assets'));
        $this->finder->deleteDirectory($this->getModulesPath('Tests'));

        $files = $this->getModulesPaths([
            'Config/.gitkeep',
            'Config/config.php',
            'Entities/.gitkeep',
            'Database/Migrations/.gitkeep',
            'Http/Controllers/.gitkeep',
            'Http/Requests/.gitkeep',
            "Http/Controllers/{$this->name}Controller.php",
            'Providers/.gitkeep',
            'Providers/RouteServiceProvider.php',
            'Resources/lang/.gitkeep',
            'Resources/views/.gitkeep',
            'Routes/.gitkeep',
            'Routes/web.php',
            'Routes/api.php',
            'package.json',
            'webpack.mix.js',
        ]);

        $this->finder->delete($files);
    }

    /**
     * Add data to module.json file.
     *
     * @return void
     */
    private function addDataToModuleJson()
    {
        $moduleJson = $this->finder->get($this->getModulesPath('module.json'));

        $moduleJson = $this->setModulePriority($moduleJson);

        $this->finder->put($this->getModulesPath('module.json'), $moduleJson);
    }

    /**
     * Set the module priority for composer.json file.
     *
     * @return string
     */
    private function setModulePriority($content)
    {
        return str_replace('"priority": 0,', '"priority": 100,', $content);
    }

    /**
     * Remove unneeded data from module.json file.
     *
     * @return void
     */
    private function cleanupModuleJsonFile()
    {
        $moduleJson = $this->finder->get($this->getModulesPath('module.json'));

        $moduleName = ucfirst($this->name);

        // Update module description.
        $search = <<<JSON
"description": "",
JSON;

        $replace = <<<JSON
"description": "The FleetCart {$moduleName} Module.",
JSON;

        $moduleJson = str_replace($search, $replace, $moduleJson);

        // Remove "keywords" node.
        $search = <<<JSON
"keywords": [],
JSON;

        $moduleJson = str_replace($search, '', $moduleJson);

        // Remove unneeded nodes.
        $search = <<<JSON
],
    "aliases": {},
    "files": [],
    "requires": []
JSON;

        $moduleJson = str_replace($search, ']', $moduleJson);

        $this->finder->put($this->getModulesPath('module.json'), $moduleJson);
    }

    /**
     * Add data to composer.json file.
     *
     * @return void
     */
    private function addDataToComposerJsonFile()
    {
        $composerJson = $this->finder->get($this->getModulesPath('composer.json'));

        $moduleName = ucfirst($this->name);

        $composerJsonText = '';

        foreach (explode(PHP_EOL, $composerJson) as $lineNumber => $textLine) {
            if ($lineNumber === 2) {
                $composerJsonText .= "    \"description\": \"The FleetCart {$moduleName} Module.\"," . PHP_EOL;

                continue;
            } elseif ($lineNumber >= 9 && $lineNumber <= 23) {
                continue;
            }

            $composerJsonText .= $textLine . PHP_EOL;
        }

        $search = <<<JSON
],
JSON;

        $replace = <<<JSON
],
    "require": {
        "php": ">=7.3.0"
    },
    "autoload": {
        "psr-4": {
            "Modules\\\\{$moduleName}\\\\": ""
        }
    },
    "extra": {
        "branch-alias": {
            "dev-master": "1.0.x-dev"
        }
    },
    "config": {
        "sort-packages": true
    },
    "minimum-stability": "dev"
}
JSON;

        $composerJson = str_replace($search, $replace, $composerJsonText);

        $this->finder->put($this->getModulesPath('composer.json'), $composerJson);
    }
}
