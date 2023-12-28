<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Modules\Core\Http\Models\Menu;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UpdateMenu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'menu:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the menu based on web routes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $routes = Route::getRoutes();

        foreach ($routes as $route) {
            // Skip API routes
            if (str_starts_with($route->uri, 'api')) {
                continue;
            }
            if (str_starts_with($route->uri, 'admin')) {
                // Get the route name
                $routeName = $route->getName();

                // Skip routes with specific names
                if (str_contains($routeName, 'create') || str_contains($routeName, 'show') || str_contains($routeName, 'store') || str_contains($routeName, 'update') || str_contains($routeName, 'destroy') || str_contains($routeName, 'edit')) {
                    $this->info('Skipping route: ' . $routeName);
                    continue;
                }

                // Update or create menu item
                $menuItem = Menu::updateOrCreate(
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

                // Update or create permission
                $permission = Permission::firstOrCreate(['name' => $routeName]);

                // Assign permission to admin role
                $admin = Role::where('name', 'admin')->first();
                if ($admin) {
                    $admin->givePermissionTo($routeName);
                } else {
                    $admin = Role::create(['name' => 'admin']);
                    $admin->givePermissionTo($routeName);
                }

                $this->info('Added to menu: ' . $routeName);
            }
        }

        $this->info('Menu and permissions updated successfully.');

        return 0;
    }
}
