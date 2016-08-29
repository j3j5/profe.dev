<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Asset;

class MainController extends Controller {

    protected $images_base_url;
    protected $files_base_url;
    protected $create_model_url;
    protected $edit_base_url;
    protected $delete_base_url;
    protected $model;

    public function __construct()
    {
        Asset::add("js/app.js");
        Asset::add("css/app.css");

        if(app()->environment('production')) {
            $this->images_base_url = "https://f001.backblaze.com/file/" . config('b2client.bucket_name');
            $this->files_base_url = "https://f001.backblaze.com/file/" . config('b2client.bucket_name');
        } else {
            $this->images_base_url = "http://{$_SERVER['HTTP_HOST']}/uploads/";
            $this->files_base_url = "http://{$_SERVER['HTTP_HOST']}/uploads/";
        }
    }

    public function index(Request $request, $table)
    {
        $model = str_singular(ucfirst(camel_case($table)));
        $model = "App\Models\\$model";
        $model::bootstrap($this);

        $js_variables = "var IMG_BASE_URL = \"{$this->images_base_url}\";";
        $js_variables .= PHP_EOL . "var FILES_BASE_URL = \"{$this->files_base_url}\";";

        // $js_variables .= PHP_EOL . "var TABLE_ENDPOINT = \"" . route('getTableValues', $table) . "\";";

        $filters = $request->except('page', 'direction', 'column');

        $direction = 'asc';
        if ($request->has('direction')) {
            if ($request->get('direction') == 'asc') {
                $direction = 'desc';
            }
        }

        $js_variables .= PHP_EOL . "var NAME = \"$model\";";

        Asset::addScript($js_variables, 'footer');
        return view('main.index-vue', [
            'model' => $table,
        ]);
    }

    public function store($tableName, Request $request)
    {
        // dd($tableName, $request->input());
        $this->validate($request, config('vivify.validationRules.' . $tableName));
        //
        // $data = $this->parseInputData($request);
        //
        // if (\Schema::hasColumn($tableName, 'created_at')) {
        //     $data['created_at'] = \Carbon\Carbon::now();
        //     $data['updated_at'] = $data['created_at'];
        // }
        //
        // $hasMany = null;
        //
        // if (@$data['hasMany']) {
        //     $hasMany = $data['hasMany'];
        //     unset($data['hasMany']);
        // }
        //
        // $belongsToMany = null;
        //
        // if (@$data['belongsToMany']) {
        //     $belongsToMany = $data['belongsToMany'];
        //     unset($data['belongsToMany']);
        // }

        $model = "App\Models\\" . Str::studly(Str::singular($tableName));
        if (class_exists($model)) {
            $new = $model::create($request->input());
            $id = $new->id;
        }

        if ($request->expectsJson()) {
            return response()->json($new);
        } else {
            return redirect()->back();
        }

        if ($hasMany) {
            $form = $this->getForm($tableName);
            foreach ($hasMany as $table => $ids) {
                $model = "App\Models\\" . Str::studly(Str::singular($table));
                if (class_exists($model)) {
                    $model::whereIn('id', $ids)->get()->each(function($item, $key) use($options, $id) {
                        $item::update([ $form['hasMany'][$table]['column'] => $id ]);
                    });
                } else {
                    \DB::table($table)->whereIn('id', $ids)->update([ $form['hasMany'][$table]['column'] => $id ]);
                }
            }
        }

        if ($belongsToMany) {
            $form = $this->getForm($tableName);
            foreach ($belongsToMany as $table => $ids) {
                foreach ($ids as $pivotId) {
                    $model = "App\Models\\" . Str::studly(Str::singular($form['belongsToMany'][$table]['table']));
                    if (class_exists($model)) {
                        $model::create([$form['belongsToMany'][$table]['column'] => $id, $form['belongsToMany'][$table]['foreignLabel'] => $pivotId]);
                    } else {
                        \DB::table($form['belongsToMany'][$table]['table'])->insert([$form['belongsToMany'][$table]['column'] => $id, $form['belongsToMany'][$table]['foreignLabel'] => $pivotId]);
                    }
                }
            }
        }

        return redirect(config('vivify.prefix') . '/' . $tableName);
    }

    public function delete($tableName, $id)
    {
        $model = "App\Models\\" . Str::studly(Str::singular($tableName));
        if (class_exists($model)) {
            $model::where('id', $id)->first()->delete();
        } else {
            \DB::table($tableName)->where('id', $id)->delete();
        }

        return redirect()->back();
    }
















    private function getForm($tableName)
    {
        $form = config('vivify.forms.' . $tableName);
        foreach ($form as $key => &$value) {
            if (is_numeric($key)) {
                $form[$value] = [ 'label' => ucfirst($value), 'type' => 'text' ];
                unset($form[$key]);
            }
        }
        return $form;
    }

    private function getBelongsToColumns($form)
    {
        $belongsTo = null;

        if (@$form['belongsTo']) {
            foreach ($form['belongsTo'] as $table => $options) {
                $belongsTo[$table] = \DB::table($table)->orderBy($options['foreignLabel'], 'asc')->lists($options['foreignLabel'], 'id');
                if (@$options['nullable']) {
                    $belongsTo[$table] = ['' => 'None'] + $belongsTo[$table];
                }
            }
        }

        return $belongsTo;
    }

    private function getHasManyColumns($form)
    {
        $hasMany = null;

        if (@$form['hasMany']) {
            foreach ($form['hasMany'] as $table => $options) {
                $hasMany[$table] = \DB::table($table)->orderBy($options['foreignLabel'], 'asc')->lists($options['foreignLabel'], 'id');
            }
        }

        return $hasMany;
    }

    private function getSelectedHasManyColumns($form, $id)
    {
        $selectedHasMany = null;

        if (@$form['hasMany']) {
            foreach ($form['hasMany'] as $table => $options) {
                $selectedHasMany[$table] = \DB::table($table)->where($options['column'], $id)->lists('id');
            }
        }

        return $selectedHasMany;
    }

    private function getBelongsToManyColumns($form)
    {
        $belongsToMany = null;

        if (@$form['belongsToMany']) {
            foreach ($form['belongsToMany'] as $table => $options) {
                $belongsToMany[$table] = \DB::table($table)->orderBy($options['index'], 'asc')->lists($options['index'], 'id');
            }
        }

        return $belongsToMany;
    }

    private function getSelectedBelongsToManyColumns($form, $id)
    {
        $selectedBelongsToMany = null;

        if (@$form['belongsToMany']) {
            foreach ($form['belongsToMany'] as $table => $options) {
                $selectedBelongsToMany[$table] = \DB::table($options['table'])->where($options['column'], $id)->lists($options['foreignLabel'], 'id');
            }
        }

        return $selectedBelongsToMany;
    }


    public function __set($name, $value)
    {
        if(isset($this->$name)) {
            $this->$name = $value;
        }
    }
}
