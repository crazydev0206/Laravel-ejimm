<?php

namespace FleetCart\Scaffold\Module\Generators;

use DateTime;

class EntityGenerator extends Generator
{
    /**
     * Array of views to be generated.
     *
     * @var array
     */
    protected $views = [
        'views/index.stub' => 'Resources/views/admin/$ENTITY_NAME$/index.blade.php',
        'views/create.stub' => 'Resources/views/admin/$ENTITY_NAME$/create.blade.php',
        'views/edit.stub' => 'Resources/views/admin/$ENTITY_NAME$/edit.blade.php',
        'views/shortcuts.stub' => 'Resources/views/admin/$ENTITY_NAME$/partials/shortcuts.blade.php',
    ];

    /**
     * Generate the given entities.
     *
     * @param array $entities
     * @param bool $generateSidebar
     * @return void
     */
    public function generate(array $entities, $generateSidebar = true)
    {
        if (count($entities) !== 0 && $generateSidebar) {
            $this->generateSidebarExtender($entities);
        }

        foreach ($entities as $entity) {
            $this->appendPermissions($entity);
            $this->generateMigrations($entity);
            $this->generateEntity($entity);
            $this->generateController($entity);
            $this->generateRequests($entity);
            $this->generateLang($entity);
            $this->generateViews($entity);
            $this->appendRoutes($entity);
            $this->appendSidebarExtender($entity);
        }
    }

    /**
     * Generate a filled sidebar view composer
     * Or an empty one of no entities.
     *
     * @param $entities
     * @return void
     */
    private function generateSidebarExtender($entities)
    {
        return $this->finder->put(
            $this->getModulesPath('Sidebar/SidebarExtender.php'),
            $this->getContentForStub('sidebar/sidebar-extender.stub', $entities[0])
        );
    }

    /**
     * Append permissions.
     *
     * @param string $entity
     * @return void
     */
    private function appendPermissions($entity)
    {
        $permissionsContent = $this->finder->get($this->getModulesPath('Config/permissions.php'));

        $this->finder->put(
            $this->getModulesPath('Config/permissions.php'),
            str_replace('// append', $this->getContentForStub('config/permissions-append.stub', $entity), $permissionsContent)
        );
    }

    /**
     * Generate migrations file for eloquent entities.
     *
     * @param string $entity
     * @return void
     */
    private function generateMigrations($entity)
    {
        $entityName = snake_case(str_plural($entity));
        $migrationFileName = $this->getDateTimePrefix() . "create_{$entityName}_table.php";

        $this->finder->put(
            $this->getModulesPath("Database/Migrations/{$migrationFileName}"),
            $this->getContentForStub('migrations/create-table-migration.stub', $entity)
        );

        $migrationFileName = $this->getDateTimePrefix() . 'create_' . str_singular($entityName) . '_translations_table.php';

        $this->finder->put(
            $this->getModulesPath("Database/Migrations/{$migrationFileName}"),
            $this->getContentForStub('migrations/create-translation-table-migration.stub', $entity)
        );
    }

    /**
     * Get the current time with microseconds.
     *
     * @return string
     * @return void
     */
    private function getDateTimePrefix()
    {
        $time = microtime(true);
        $micro = sprintf('%06d', ($time - floor($time)) * 1000000);
        $date = new DateTime(date('Y-m-d H:i:s.' . $micro, $time));

        return $date->format('Y_m_d_Hisu_');
    }

    /**
     * Generate entity.
     *
     * @param string $entity
     * @return void
     */
    private function generateEntity($entity)
    {
        $this->finder->put(
            $this->getModulesPath("Entities/{$entity}.php"),
            $this->getContentForStub('entities/entity.stub', $entity)
        );

        $this->finder->put(
            $this->getModulesPath("Entities/{$entity}Translation.php"),
            $this->getContentForStub('entities/translation-entity.stub', $entity)
        );
    }

    /**
     * Generate the controller for the given entity.
     *
     * @param string $entity
     * @return void
     */
    private function generateController($entity)
    {
        $this->createDirectory('Http/Controllers/Admin');

        $this->finder->put(
            $this->getModulesPath("Http/Controllers/Admin/{$entity}Controller.php"),
            $this->getContentForStub('admin-controller.stub', $entity)
        );
    }

    /**
     * Generate the requests for the given entity.
     *
     * @param string $entity
     * @return void
     */
    private function generateRequests($entity)
    {
        $this->createDirectory('Http/Requests');

        $this->finder->put(
            $this->getModulesPath("Http/Requests/Save{$entity}Request.php"),
            $this->getContentForStub('save-entity-request.stub', $entity)
        );
    }

    /**
     * Generate views for the given entity.
     *
     * @param string $entity
     * @return void
     */
    private function generateViews($entity)
    {
        $entityName = snake_case(str_plural($entity));

        $this->createDirectory("Resources/views/admin/{$entityName}/partials");

        foreach ($this->views as $stub => $view) {
            $view = str_replace('$ENTITY_NAME$', $entityName, $view);

            $this->finder->put(
                $this->getModulesPath($view),
                $this->getContentForStub($stub, $entity)
            );
        }
    }

    /**
     * Generate language files for the given entity.
     *
     * @param string $entity
     * @return void
     */
    private function generateLang($entity)
    {
        $this->createDirectory('Resources/lang/en');

        $entityName = snake_case(str_plural($entity));

        $this->finder->put(
            $this->getModulesPath("Resources/lang/en/{$entityName}.php"),
            $this->getContentForStub('lang/entity.stub', $entity)
        );

        $this->finder->put(
            $this->getModulesPath('Resources/lang/en/permissions.php'),
            $this->getContentForStub('lang/permissions.stub', $entity)
        );

        $this->finder->put(
            $this->getModulesPath('Resources/lang/en/attributes.php'),
            $this->getContentForStub('lang/attributes.stub', $entity)
        );
    }

    /**
     * Append the routes for the given entity to the routes file.
     *
     * @param string $entity
     * @return void
     */
    private function appendRoutes($entity)
    {
        $routeContent = $this->finder->get($this->getModulesPath('Routes/admin.php'));

        $this->finder->put(
            $this->getModulesPath('Routes/admin.php'),
            str_replace('// append', $this->getContentForStub('routes/routes-append.stub', $entity), $routeContent)
        );
    }

    /**
     * Append sidebar extender.
     *
     * @param string $entity
     * @return void
     */
    private function appendSidebarExtender($entity)
    {
        $sidebarComposerContent = $this->finder->get($this->getModulesPath('Sidebar/SidebarExtender.php'));

        $this->finder->put(
            $this->getModulesPath('Sidebar/SidebarExtender.php'),
            str_replace('// append', $this->getContentForStub('sidebar/sidebar-extender-append.stub', $entity), $sidebarComposerContent)
        );
    }
}
