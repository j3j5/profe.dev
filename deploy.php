<?php
/*
 * This file has been generated automatically.
 * Please change the configuration for correct use deploy.
 */

require 'recipe/laravel.php';

// Set configurations
set('repository', 'https://github.com/j3j5/profe.dev.git');
set('shared_files', ['.env']);
set('shared_dirs', [
    'storage/app',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
]);
set('writable_dirs', ['bootstrap/cache', 'storage']);

// Configure servers
server('production', '173.230.150.126:213')
    ->user('j3j5')
    ->forwardAgent()
    ->env('deploy_path', '/webservers/dep/profemariana.com');

server('beta', '173.230.150.126:213')
    ->user('j3j5')
    ->forwardAgent()
    ->env('deploy_path', '/webservers/dep/beta.profemariana.com');



/**
 * TASKS
 */

/**
 * Restart apache on success deploy.
 */
task('apache:reload', function () {
    run('sudo /usr/sbin/service apache2 reload');
})->desc('Reload apache2 service');

/**
 * Install NPM dependencies
 */
task('npm:install', function () {
    run('npm install');
})->desc('Install NPM dependencies');

/**
 * Compile assets with Gulp
 */
task('gulp:compile', function () {
    run('gulp --production');
})->desc('Compile assets with gulp');

after('deploy:vendors', 'npm:install');
after('deploy:vendors', 'gulp:compile');
before('success', 'artisan:migrate');
after('success', 'apache:reload');
