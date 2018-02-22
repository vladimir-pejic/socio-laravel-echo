<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Statuses\UserStatus;
use App\Models\Statuses\UserStatusComment;
use App\Models\Users\User;
use App\Notifications\Liked;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //
    public function likeUserStatus($id)
    {
        $this->handleLike('App\Models\Statuses\UserStatus', $id);
        return redirect()->back();
    }

    public function likeUserStatusComment($id)
    {
        $this->handleLike('App\Models\Statuses\UserStatusComment', $id);
        return redirect()->back();
    }

    public function handleLike($type, $id)
    {
        $existing_like = Like::withTrashed()->whereLikeableType($type)->whereLikeableId($id)->whereUserId(User::getUser()->id)->first();
        $liked = $type::find($id);
        $liked_by = User::getUser();
        $receiver = User::find($liked->origin_user_id);
        if (is_null($existing_like)) {
            Like::create([
                'user_id'       => $liked_by->id,
                'likeable_id'   => $id,
                'likeable_type' => $type,
            ]);
            $receiver->notify(new Liked($liked, $liked_by));
        } else {
            if (is_null($existing_like->deleted_at)) {
                $existing_like->delete();
            } else {
                $existing_like->restore();
            }
        }
    }

    public function likesUserStatus($id) {
        $model = UserStatus::findOrFail($id);
        $html=view('includes.modals.likes', compact('model'))->render();
        return ['status'=>'success','html'=>$html];
    }

    public function likesUserStatusComment($id) {
        $model = UserStatusComment::findOrFail($id);
        $html=view('includes.modals.likes', compact('model'))->render();
        return ['status'=>'success','html'=>$html];
    }
}
