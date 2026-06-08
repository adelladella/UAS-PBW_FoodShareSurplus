<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Neon Database SNI support for older postgres client libraries (libpq)
        $connections = $this->app['config']->get('database.connections', []);
        foreach ($connections as $name => $config) {
            if ($config && isset($config['driver']) && $config['driver'] === 'pgsql') {
                // 1. Parse connection URL manually to ensure full compatibility without framework dependencies
                if (!empty($config['url'])) {
                    $parsedUrl = parse_url($config['url']);
                    if ($parsedUrl) {
                        if (isset($parsedUrl['host'])) {
                            $config['host'] = $parsedUrl['host'];
                        }
                        if (isset($parsedUrl['port'])) {
                            $config['port'] = $parsedUrl['port'];
                        }
                        if (isset($parsedUrl['user'])) {
                            $config['username'] = $parsedUrl['user'];
                        }
                        if (isset($parsedUrl['pass'])) {
                            $config['password'] = $parsedUrl['pass'];
                        }
                        if (isset($parsedUrl['path'])) {
                            $config['database'] = ltrim($parsedUrl['path'], '/');
                        }
                        if (isset($parsedUrl['query'])) {
                            parse_str($parsedUrl['query'], $queryOpts);
                            if (isset($queryOpts['sslmode'])) {
                                $config['sslmode'] = $queryOpts['sslmode'];
                            }
                        }
                        // Remove url key to prevent Laravel from parsing it again
                        unset($config['url']);
                    }
                }
                
                // 2. Inject endpoint ID options with single quote format for PDO compatibility
                $host = $config['host'] ?? '';
                if (is_string($host) && strpos($host, 'neon.tech') !== false) {
                    $parts = explode('.', $host);
                    $endpointId = $parts[0];
                    
                    $sslMode = $config['sslmode'] ?? 'require';
                    $sslMode = explode(';', $sslMode)[0]; // Remove any previously appended options
                    
                    $config['sslmode'] = "{$sslMode};options='endpoint={$endpointId}'";
                    
                    $this->app['config']->set("database.connections.{$name}", $config);
                }
            }
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
