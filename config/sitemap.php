<?php

/* Simple configuration file for Laravel Sitemap package */
return [
	'use_cache'			=> 	true,
	'cache_key'			=> 	'laravel-sitemap.' . config('app.url'),
	'cache_duration'	=> 	6*24*60,
	'escaping'			=> 	true,
	'use_limit_size'	=> 	false,
	'max_size'			=> 	null,
	'use_styles'		=> 	true,
	'styles_location'	=> 	null,
];
