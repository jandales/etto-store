<?php

namespace App\Http\Controllers;

use App\Exceptions\SendMessageException;
use App\Jobs\ProccessMessage;
use App\Http\Requests\MessageRequest;

class MessageController extends Controller
{
    public function __invoke(MessageRequest $request)
    {
        $flashMessage = [];      

        try {

            dispatch(new ProccessMessage(
                $request->email,
                $request->name,
                $request->content
            ));

            $flashMessage['success'] = true;
            $flashMessage['message'] = 'Message successfully submitted';

        } catch (SendMessageException $e) {                    
            $flashMessag['error'] = true;
            $flashMessag['message'] = 'Message not sent, Please try again';          
        }


        return back()->with($flashMessage);
        
    }
}
