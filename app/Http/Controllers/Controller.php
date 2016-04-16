<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Carbon\Carbon;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sitemap($format = false)
    {
        switch($format) {
            case 'ror-rdf':
            case 'ror-rss':
            case 'txt':
            case 'html':
                break;
            default:
                $format = 'xml';
                break;
        }

        // create new sitemap object
        $sitemap = \App::make("sitemap");

        // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
        // by default cache is disabled
        $sitemap->setCache('laravel.sitemap', 6*24*60);

        // check if there is cached sitemap and build new only if is not
        if (!$sitemap->isCached())
        {
            $last_modified = Carbon::now()->startOfWeek()->hour(9);
            // add item to the sitemap (url, date, priority, freq)
            $sitemap->add(route('Home'), $last_modified->toAtomString(), '1.0', 'weekly');
            // Cursos
            foreach (['primero', 'segundo', 'tercero'] as $curso) {
                $sitemap->add(route("curso", [$curso]), $last_modified->toAtomString(), '1.0', 'weekly');
                $sitemap->add(route("Propuestas", [$curso]), $last_modified->toAtomString(), '1.0', 'weekly');
                $sitemap->add(route("Gallery", [$curso]), $last_modified->toAtomString(), '1.0', 'weekly');
                $sitemap->add(route("Glossary", [$curso]), $last_modified->toAtomString(), '1.0', 'weekly');
            }

        }

        // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return $sitemap->render($format);
    }
}
