<?php

namespace App\Console\Commands;

use Future\Core\Http\Models\Menu;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UpdateMenu extends Command
{
    protected $signature = 'menu:update';
    protected $description = 'Update the menu based on web routes';

    protected $skipNames = ['create', 'show','unisharp.lfm','ignition','forgot-password','sanctum','livewire.upload-file', 'store', 'update', 'destroy', 'edit'];
    protected $skipUris = ['login', 'register', 'logout', 'forgot-password', 'reset-password'];

    public function handle()
    {
        $routes = Route::getRoutes();
        $admin = $this->getAdminRole();

        foreach ($routes as $route) {
            if ($this->shouldSkipRoute($route)) {
                continue;
            }

            $this->updateMenuAndPermissions($route, $admin);
        }

        $this->info('Menu and permissions updated successfully.');

        return 0;
    }

    protected function shouldSkipRoute($route)
    {
        $routeName = $route->getName();

        if (str_starts_with($route->uri, 'api')) {
            return true;
        }

        $shouldSkipName = array_reduce($this->skipNames, function ($carry, $item) use ($routeName) {
            return $carry || str_contains($routeName, $item);
        }, false);

        if ($shouldSkipName) {
            $this->info('Skipping route: ' . $routeName);
            return true;
        }

        $shouldSkipUri = array_reduce($this->skipUris, function ($carry, $item) use ($route) {
            return $carry || str_contains($route->uri, $item);
        }, false);

        if (str_contains($route->uri, '{') || $shouldSkipUri) {
            $this->info('Skipping route with slug: ' . $routeName);
            return true;
        }

        return false;
    }

    protected function updateMenuAndPermissions($route, $admin)
    {
        $routeName = $route->getName();

        if ($routeName === null) {
            $this->info('Skipping route with no name');
            return;
        }

        Menu::updateOrCreate(
            [
                'url' => $route->uri,
                'title' => $route->uri === 'admin' ? 'Dashboard' : ucfirst(str_replace('admin/', '', $route->uri)),
                'permission' => $routeName,
            ],
            [
                'parent_id' => null,
                'order' => 0,
                'icon' => 'fas fa-tachometer-alt',
                'badge' => null
            ]
        );

        Permission::firstOrCreate(['name' => $routeName]);
        $admin->givePermissionTo($routeName);

        $this->info('Added to menu: ' . $routeName);
    }

    protected function getAdminRole()
    {
        $admin = Role::where('name', 'admin')->first();

        if (!$admin) {
            $admin = Role::create(['name' => 'admin']);
        }

        return $admin;
    }
}
