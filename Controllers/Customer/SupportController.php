<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $messages = Message::with(['sender', 'recipient'])
            ->where('accountID', $user->accountID)
            ->orWhere('recipientID', $user->accountID)
            ->orderBy('messageNumber', 'desc')
            ->get();
        return view('customer.support.index', compact('messages'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:1000'
        ]);

        Message::create([
            'accountID' => Auth::id(),
            'recipientID' => 1,
            'text' => $request->text,
        ]);

        return redirect()->back()->with('success', 'Your message has been sent to support.');
    }

    // إرجاع المحادثة بين المستخدم والدعم الفني
    public function getConversation($messageNumber)
    {
        $mainMessage = Message::findOrFail($messageNumber);
        $user = Auth::user();
        $messages = Message::with('sender')
            ->where(function ($q) use ($user) {
                $q->where('accountID', $user->accountID)
                    ->orWhere('recipientID', $user->accountID);
            })
            ->where(function ($q) use ($mainMessage) {
                $q->where('accountID', $mainMessage->accountID)
                    ->orWhere('recipientID', $mainMessage->accountID);
            })
            ->orderBy('messageNumber', 'asc')
            ->get();
        return response()->json($messages);
    }
}
