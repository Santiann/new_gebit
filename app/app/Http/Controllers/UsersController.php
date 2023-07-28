<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Config;
use Yajra\DataTables\Contracts\DataTable;

class UsersController extends Controller
{
    public function index()
    {
        return view('sistema/users');
    }
    public function usersList()
    {
        $users = DB::table('users')->select('*');
        return datatables()->of($users)
            ->make(true);
    }
}
