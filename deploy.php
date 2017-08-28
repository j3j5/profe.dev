<?php

namespace Deployer;

require 'recipe/laravel.php';

// require_once __DIR__ . '/deploy/assets.php';
// require_once __DIR__ . '/deploy/supervisor.php';

set('ssh_type', 'native');
set('ssh_multiplexing', true);

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
    ->set('deploy_path', '/webservers/profemariana.com'); // Define the base path to deploy your project to.


server('beta', '173.230.150.126', 213)
        ->user('j3j5')
        ->forwardAgent() // You can use identity key, ssh config, or username/password to auth on the server.
        ->stage('beta')
        ->set('deploy_path', '/webservers/beta.profemariana.com'); // Define the base path to deploy your project to.

set('writable_mode', 'chmod');
set('shared_files', ['.env']);
set('shared_dirs', [
    'storage',
    'node_modules'
]);
set('writable_dirs', ['bootstrap/cache', 'storage/app']);

set('default_stage', 'production');

before('deploy:symlink', 'assets:generate');

after('artisan:config:cache', 'artisan:route:cache');
after('artisan:route:cache', 'artisan:migrate');

after('deploy', 'success');

set('bin/npm', function () {
    return run('which npm')->toString();
});

task('npm:install', function () {
    $npm_folder_exists = run('if [ ! -L {{deploy_path}}/shared/node_modules ] && [ -d {{deploy_path}}/shared/node_modules ]; then echo true; fi')->toBool();
    if(!$npm_folder_exists) {
        run('cd {{deploy_path}}/current; {{bin/npm}} install');
        run('mv {{deploy_path}}/current/node_modules  {{deploy_path}}/shared');
    }
    run('ln -s {{deploy_path}}/shared/node_modules {{deploy_path}}/current/node_modules');
})->desc('Execute npm install');

task('assets:generate', function () {
    run('cd {{deploy_path}}/current; gulp --production');
})->desc('Generating assets');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
