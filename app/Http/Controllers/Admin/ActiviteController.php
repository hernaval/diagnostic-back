<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Model\Activity;

class ActiviteController extends Controller
{
    public function indexUser($id)
    {
        return response()->json(
            Activity::where(['userId' => $id])->get()
        );
    }

    public function destroy()
    {
        Activity::truncate();
        return response()->json("success");
    }
}
