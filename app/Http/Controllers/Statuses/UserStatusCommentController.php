<?php

namespace App\Http\Controllers\Statuses;

use App\Models\Statuses\UserStatusComment;
use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserStatusCommentController extends Controller
{
    //
    public function store(Request $request, $status_id)
    {
        $rules = ['content' => 'required'];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails())
            return redirect()->back()->withInput()->withErrors($validate);

        $input = $request->all();
        $input['status_id'] = $status_id;
        $input['user_id'] = User::getUser()->id;
        UserStatusComment::create($input);
        return redirect()->back();
    }
}
