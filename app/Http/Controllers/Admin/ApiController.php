<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function getTableValues($table)
    {
        $columns = config('vivify.columns.' . $table);
        $values = \DB::table($table)->get();

        $response = ['columns' => $columns, 'values' => $values];

        return response()->json($response);
    }
}
