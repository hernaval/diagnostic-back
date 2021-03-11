<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;


class Activity extends Model
{
    protected $table = 'activity';
    protected $guarded = [''];

    public static function type()
    {
        return array(
            'register_account' => "REGISTER_ACCOUNT",
            'login_account' => "LOGIN_ACCOUNT",
            'forgot_account' => "FORGOT_ACCOUNT",
            "reset_account" => "RESET_ACCOUNT",
            "confirm_account" => "CONFIRM_ACCOUNT",
            "post_questionnaire" => "POST_QUESTIONNAIRE",
            "get_questionnaire" => "GET_QUESTIONNAIRE",
            "delete_questionnaire" => "DELETE_QUESTIONNAIRE",
            "put_info" => "PUT_INFO",
            "view_article" => "VIEW_ARTICLE",
            "save_article " => "SAVE_ARTICLE",
            "unsave_article" => "UNSAVE_ARTICLE",
            
            "view_page" => "VIEW_PAGE"
        );
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function asignActivityToUser($user, $type, $detail="act")
    {
        return Activity::create([
            'userId' => $user,
            'activiteType' => $type,
            'activiteDetail' => $detail
        ]);
    }

   
}
