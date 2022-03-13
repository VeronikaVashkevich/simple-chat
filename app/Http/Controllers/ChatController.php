<?php


namespace App\Http\Controllers;


use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chat(Request $request) {

        if ($request->ajax()) {
            if (isset($request->name) && isset($request->text)) {
                $message = new Message;

                $message->name = $request->name;
                $message->text = $request->text;

                $message->save();
            }

            return view('messages', [
                'messages' => Message::all(),
            ])->render();
        }

        return view('chat', [
            'messages' => Message::all(),
        ]);
    }

    public function getMessages(Request $request) {
        if ($request->ajax()) {
            return view('messages', [
                'messages' => Message::all(),
            ])->render();
        }
    }
}
