<?php

namespace App\Http\Controllers\API;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatsController extends Controller
{

    /**
     * Fetch all messages
     *
     * @return array
     */
    public function fetchMessages(Request $request)
    {
        $user = User::where('id', $request->header('id'))->first();

        return $user->messages()->get()->toArray();
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(Request $request)
    {
        $sender = User::where('id', $request->header('id'))->first();

        //TODO Сделать массивчик и валидацию кому отправилось

        $message = new Message([
            'message' => $request->input('message'),
            'receiver_id' => $request->input('receiver_id'),
            'sender_id' => $sender->id
        ]);
        $message->save();

        broadcast(new MessageSent($sender, $message))->toOthers();

        return \response()->json(['status' => 'Message Sent!']);
    }
}
