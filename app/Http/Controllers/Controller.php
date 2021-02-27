<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getAllActive(Request $request)
    {
        {
            $table = $request->input('table');
            $column = ($request->has('column')) ? $request->input('column') : 'name';
            $order = ($request->has('order')) ? $request->input('order') : 'asc';

            $data = ("App\\" . Str::studly(Str::singular($table)))::orderBy($column, $order)->get();

            return response()->json(['data' => $data, 'message' => null], 200);
        }
    }
}
