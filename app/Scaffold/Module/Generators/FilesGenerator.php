<?php

namespace FleetCart\Scaffold\Module\Generators;

use Illuminate\Contracts\Filesystem\FileNotFoundException;

class FilesGenerator extends Generator
{
    /**
     * Generate the given files.
     *
     * @param  array $files
     * @return void
     */
    public function generate(array $files)
    {
        foreach ($files as $stub => $file) {
            $this->finder->put(
                $this->getModulesPath($file),
                $this->getContentFor($stub)
            );
        }
    }

    /**
     * Generate the base module service provider.
     *
     * @return $this
     */
    public function generateModuleProvider()
    {
        $this->finder->put(
            $this->getModulesPath("Providers/{$this->name}ServiceProvider.php"),
            $this->getContentFor('providers/module-service-provider.stub')
        );

        return $this;
    }

    /**
     * Get the content for the given file.
     *
     * @param string $stub
     * @return string
     *
     * @throws FileNotFoundException
     */
    private function getContentFor($stub)
    {
        $stub = $this->finder->get($this->getStubPath($stub));

        return str_replace(
            ['$MODULE$', '$LOWERCASE_MODULE$', '$PLURAL_MODULE$', '$UPPERCASE_PLURAL_MODULE$'],
            [$this->name, strtolower($this->name), strtolower(str_plural($this->name)), str_plural($this->name)],
            $stub
        );
    }
}
