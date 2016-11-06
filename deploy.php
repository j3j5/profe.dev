<?php

require_once 'recipe/common.php';
require_once __DIR__ . '/deploy/laravel.php';
require_once __DIR__ . '/deploy/assets.php';
require_once __DIR__ . '/deploy/supervisor.php';

// Specify the repository from which to download your project's code.
// The server needs to have git installed for this to work.
// If you're not using a forward agent, then the server has to be able to clone
// your project from this repository.
set('repository', 'https://github.com/j3j5/profe.dev.git');

// Define a server for deployment.
server('production', '173.230.150.126', 213)
    ->user('j3j5')
    ->forwardAgent() // You can use identity key, ssh config, or username/password to auth on the server.
    ->stage('production')
    ->env('deploy_path', '/webservers/profemariana.com'); // Define the base path to deploy your project to.


server('beta', '173.230.150.126', 213)
        ->user('j3j5')
        ->forwardAgent() // You can use identity key, ssh config, or username/password to auth on the server.
        ->stage('beta')
        ->env('deploy_path', '/webservers/beta.profemariana.com'); // Define the base path to deploy your project to.

// Laravel shared dirs
set('shared_dirs', [
    'storage/app',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
]);


/**
 * Main task
 */
task('deploy', [
    'deploy:prepare',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:writable',
    'deploy:symlink',
    'env:link',
    'artisan:migrate',
    'artisan:config:cache',
    'artisan:route:cache',
    'npm:install',
    'assets:generate',
    'log:set-permissions',
    'cleanup',
])->desc('Deploy your project');

after('deploy', 'success');
