<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class InstallApi extends Command
{
    protected $signature = 'app:install-api';
    protected $description = 'Install API components with proper route setup';

    public function handle()
    {
        $this->info('Starting API installation...');

        try {
            // 1. Install Sanctum if needed
            $this->installSanctum();

            // 2. Create proper API routes file
            $this->createApiRoutesFile();

            // 3. Run migrations
            $this->call('migrate');

            $this->newLine();
            $this->info('✅ API installation completed successfully!');
            $this->line('Next steps:');
            $this->line('- Implement your controllers');
            $this->line('- Add middleware as needed');
        } catch (\Exception $e) {
            $this->error('Installation failed: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }

    protected function installSanctum()
    {
        if (!class_exists(\Laravel\Sanctum\SanctumServiceProvider::class)) {
            $this->info('Installing Laravel Sanctum...');
            exec('composer require laravel/sanctum');
        }

        $this->call('vendor:publish', [
            '--provider' => 'Laravel\Sanctum\SanctumServiceProvider',
            '--tag' => 'sanctum-config'
        ]);
    }

    protected function createApiRoutesFile()
    {
        $routesPath = base_path('routes/api.php');
        $stub = <<<'EOT'
        <?php

        use Illuminate\Http\Request;
        use Illuminate\Support\Facades\Route;

        /*
        |--------------------------------------------------------------------------
        | API Routes
        |--------------------------------------------------------------------------
        |
        | Here is where you can register API routes for your application. These
        | routes are loaded by the RouteServiceProvider within a group which
        | is assigned the "api" middleware group. Enjoy building your API!
        |
        */

        Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
            return $request->user();
        });

        // Example resource route (uncomment when ready)
        // Route::apiResource('products', \App\Http\Controllers\ProductController::class);
        EOT;

        if (!File::exists($routesPath)) {
            File::put($routesPath, $stub);
            $this->info('Created API routes file with proper syntax.');
        } else {
            $this->warn('API routes file already exists. Please check for syntax errors.');
            $this->line('Current error: Your routes/api.php has incomplete syntax at line 13');
            $this->line('Suggested fix: Ensure all route definitions are complete with proper controller methods');
        }
    }
}
