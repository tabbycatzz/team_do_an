<?php

namespace App\Services\User;

abstract class BaseService
{
    public static function imageChangeName($request)
    {
        $destinationPath = '/public/images/avatar';
        $getAvatar = $request->file('avatar');
        $avatarName = $getAvatar->getClientOriginalName();
        $avatarName = date('Y-m-d') . Time() . rand(0,99999) . '.' . $getAvatar->getClientOriginalExtension();
        $request->file('avatar')->storeAs($destinationPath, $avatarName);

        return $avatarName;
    }

    public static function uploadImage($request)
    {
        $originName = $request->file('upload')->getClientOriginalName();
        $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $request->file('upload')->getClientOriginalExtension();
        $fileName = $fileName . '_' . time() . '.' . $extension;      
        $request->file('upload')->storeAs('public/posts', $fileName);;
        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = asset('storage/posts/'. $fileName);        
        $msg = 'Uploaded image success';
        $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

        return $response;
    }
}
