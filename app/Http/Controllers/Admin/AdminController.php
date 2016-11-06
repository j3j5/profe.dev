<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Validator;
use Response;
use Asset;
use App\Http\Controllers\Controller;
use iansltx\B2Client\Client;
use iansltx\B2Client\Credentials;

class AdminController extends MainController
{

    protected $b2client;
    protected $model;

    public function __construct() {
        $this->b2client = new Client(new Credentials(config('b2client.account_id'), config('b2client.app_key')));
        parent::__construct();
    }

    public function defaultAdmin() {
        return redirect(url('/admin/propuestas'));
    }
}
