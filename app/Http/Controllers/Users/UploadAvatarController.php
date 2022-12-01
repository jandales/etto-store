<?php

namespace App\Http\Controllers\Users;

use App\Concerns\HasAvatar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AvatarRequest;
use Illuminate\Support\Facades\File;
use Exception;


class UploadAvatarController extends Controller
{
     use HasAvatar;

    public function __invoke(AvatarRequest $request)
    {

            $location = "/img/avatar/";

            if (!$request->hasFile('avatar'))  return back()->with([             
                    'error' => true,
                    'message' => 'Please select image to upload',            
            ]);


            $profile = auth()->user()->profile;
            $oldpath = $profile->avatar;

            $path = $this->upload($request, $location, 'avatar');
            $profile->avatar = $path;
            $profile->save();

            if (is_null($oldpath) === false) {
                File::delete(public_path() .  $oldpath);
            }

            return back()->with([            
                    'success' => true,
                    'message' => 'Successfully avatar updated',              
            ]); 

    }
}
