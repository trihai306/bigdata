<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Modules\Menu\App\Models\Menu;

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
                Menu::updateOrCreate(
                    [
                        'url' => $route->uri,
                        'title' => $route->uri === 'admin' ? 'Dashboard' : ucfirst(str_replace('admin/', '', $route->uri)),
                        'permission' => 'viewAny ' . ucfirst(str_replace('admin/', '', $route->uri)),
                        'parent_id' => null,
                        'order' => 0,
                        'icon' => 'fas fa-tachometer-alt',
                        'badge' => null
                    ]
                );
            }
            // Update or create menu item
        }

        // Get all menu items
        $menuItems = Menu::all();

        foreach ($menuItems as $menuItem) {
            // Check if the menu item's URL exists in the routes
            $exists = false;
            foreach ($routes as $route) {
                if ($route->uri === $menuItem->url) {
                    $exists = true;
                    break;
                }
            }

            // If the menu item's URL does not exist in the routes, delete the menu item
            if (!$exists) {
                $menuItem->delete();
            }
        }

        $this->info('Menu updated successfully.');

        return 0;
    }
}
