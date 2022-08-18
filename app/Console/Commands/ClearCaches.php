<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ClearCaches extends Command
{

    protected $signature = 'remove {option1=false} {option2=false}';

    protected $description = 'Clear all caches on system';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $this->info('Starting...');

        Artisan::call('cache:clear');
        $this->info('All caches Clear Successfully');

        Artisan::call('config:clear');
        $this->info('config Caches Clear Successfully');

        Artisan::call('route:clear');
        $this->info('Route Cache Clear Successfully');

        Artisan::call('view:clear');
        $this->info('View Caches Clear Successfully');

        Artisan::call('clear-compiled');
        $this->info('Clear Compiled Successfully');

        Artisan::call('optimize:clear');
        $this->info('Clear Optimize Successfully');

        if ($this->argument('option1') == "log") {
            $laravelLogFile = storage_path('logs/laravel.log');
            if (file_exists($laravelLogFile)) {
                unlink($laravelLogFile);
            }
            $this->info('log File Deleted Successfully');
        }

        $this->rmdir_recursive(storage_path('debugbar'));
        $this->info('Debugbar Folder Deleted Successfully');

        if ($this->argument('option2') == "session") {
            session()->flush();
            $this->rmdir_recursive(storage_path('framework/sessions'));
            $this->info('Session flushed successfully');

        }
    }

    public function rmdir_recursive($dir)
    {
        if (is_dir($dir)) {
            foreach (scandir($dir) as $file) {
                if ('.' === $file || '..' === $file || '.gitignore' == $file) continue;
                if (is_dir("$dir/$file")) $this->rmdir_recursive("$dir/$file");
                else unlink("$dir/$file");
            }
        }
    }
}
