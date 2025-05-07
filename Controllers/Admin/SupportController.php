<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Account;
use Illuminate\Http\Request;

class SupportController extends Controller
{

    public function history()
    {
        $messages = Message::with(['sender', 'recipient'])->get();
        return view('dashboard.support.history', compact('messages'));
    }


    public function index()
    {
        $messages = Message::with(['sender', 'recipient'])
            ->whereNull('reply')
             ->get();

        return view('dashboard.support.index', compact('messages'));
    }

    public function reply(Request $request, Message $message)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);
        $message->update([
            'reply' => $request->reply,
            'recipientID' => auth()->id(),
        ]);
        return back()->with('success', 'Reply sent successfully.');
    }
}
