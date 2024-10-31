<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $authUser = Auth::user();

        // Obtenir les utilisateurs avec lesquels l'utilisateur connecté a eu des conversations
        $conversationUserIds = Message::where(function ($query) use ($authUser) {
            $query->where('sender_id', $authUser->id)
                ->orWhere('receiver_id', $authUser->id);
        })
            ->get()
            ->map(function ($message) use ($authUser) {
                return $message->sender_id === $authUser->id ? $message->receiver_id : $message->sender_id;
            })
            ->unique();

        // Récupérer les utilisateurs pour afficher leurs informations
        $conversationUsers = User::whereIn('id', $conversationUserIds)->get();

        return view('messages.index', compact('conversationUsers'));
    }




    public function showConversation(User $user)
    {
        $authUser = Auth::user();

        // Récupérer les messages entre l'utilisateur authentifié et le $user
        $messages = Message::where(function ($query) use ($authUser, $user) {
            $query->where('sender_id', $authUser->id)
                ->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($authUser, $user) {
            $query->where('sender_id', $user->id)
                ->where('receiver_id', $authUser->id);
        })->orderBy('created_at', 'asc')->get();

        return view('messages.show', compact('messages', 'user'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'receiver_id' => 'required|exists:users,id',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->message,
        ]);

        $receiver = User::findOrFail($request->receiver_id);
        $receiver->notifications()->create([
            'message' => auth()->user()->name . ' vous a envoyé un nouveau message.',
            'is_read' => false,
        ]);

        return back()->with('success', 'Message envoyé.');
    }

    public function deleteConversation(User $user)
    {
        $authUser = Auth::user();

        // Supprimer tous les messages entre l'utilisateur authentifié et l'utilisateur spécifié
        Message::where(function ($query) use ($authUser, $user) {
            $query->where('sender_id', $authUser->id)
                ->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($authUser, $user) {
            $query->where('sender_id', $user->id)
                ->where('receiver_id', $authUser->id);
        })->delete();

        return redirect()->route('messages')->with('success', 'Conversation supprimée.');
    }
}
