<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Model\Activity;

class ActiviteController extends Controller
{
    public function indexUser($id)
    {
        if(request()->dateStart && request()->dateEnd){
            $activity = Activity::where([
                'created_at', '>=',request()->dateStart,
                'created_at', "<=", request()->dateEnd
            ]);
        }
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
