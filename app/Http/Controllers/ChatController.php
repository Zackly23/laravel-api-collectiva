<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\GroupChat;
use Illuminate\Http\Request;
use App\Models\MessageGroupChat;
use App\Models\MessagePrivateChat;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function getListPrivateMessage(User $user)
{
    // Ambil semua pesan pribadi yang terkait dengan user dan sender
    $messagePrivateChats = MessagePrivateChat::where('user_id', $user->user_id)->get();

    // return $messagePrivateChats;

    // Kelompokkan berdasarkan sender_id
    $groupedChats = $messagePrivateChats->groupBy('sender_id');
    
    // return $groupedChats;

    // Buat response yang sudah dimodifikasi
    $messagePrivateList = $groupedChats->map(function ($messages, $senderId) {
        // Ambil pesan terbaru dari grup
        // $latestMessage = $messages->first()->chats->first();

        return [
            'message_private_chat_id' => $messages->first()->message_private_chat_id,
            'sender_id' => $senderId,
            'sender_name' => $messages->first()->sender->first_name ?? 'Unknown',
            'latest_chat' => $messages->first()->private_chat_text ?? 'No message',
            'latest_time_chat' => $messages->first()->created_at ?? null,
            'avatar' => "../../assets/images/avatars/t2.jpg", // Anda bisa mengubah avatar sesuai kebutuhan
        ];
    })->sortByDesc('latest_time_chat')->values(); // Reset index array

    return response()->json([
        "user_id" => $user->user_id,
        "private_chat" => $messagePrivateList
    ]);
}



    public function getChatMessage(User $user, $tab) {

        if ($tab == 'private-chat'){
            //Mendapatkan Message Private list Terbaru
            $messagePrivateList = $user->messagePrivateChats->sortByDesc('created_at')->values()->first();

            //Mendapatkan sender_id nya
            $latest_sender_id = $messagePrivateList->sender->user_id;
        
            //Mendapatkan semua Message Private chat berdasarkan user id dan sender id
            $messagePrivateListChats = MessagePrivateChat::where('user_id', $user->user_id)
                                    ->where('sender_id', $latest_sender_id)
                                    ->get();

            // return $messagePrivateListChats;
            //Modifikasi Response
            $messagePrivateListChats = $messagePrivateListChats->map(function ($message) {
                return [
                    'sender_id' => $message->sender_id,
                    'sender_name' => $message->sender->first_name,
                    'chat_text' => $message->private_chat_text,
                    'chat_send_time' => $message->created_at,
                    'avatar' => "../../assets/images/avatars/t2.jpg",
                ];
            });

            // return $messagePrivateListChats;


            //Diurutkan Berdasarkan waktu kirim terbaru
            $chats = $messagePrivateListChats->sortBy('chat_send_time')->values();

            $chatId = $latest_sender_id;
            // return $messagePrivateLists;
        }

        else if($tab == 'group-chat'){
            $group_chat_id = $user->groupChats->pluck('group_chat_id');

            // dd($user->groupChats);

            $latest_group_id_activities = DB::table('message_group_chats')
                            ->select('group_chat_id', DB::raw('MAX(updated_at) as last_activity_time'))
                            ->whereIn('group_chat_id', $group_chat_id) // Filter berdasarkan daftar group_chat_id
                            ->groupBy('group_chat_id') // Kelompokkan berdasarkan group_chat_id
                            ->orderBy('last_activity_time', 'desc') // Urutkan berdasarkan waktu terbaru
                            ->first()->group_chat_id;

            // return $latest_group_id_activities;      

            $group_chat_id = MessageGroupChat::latest()
                                            ->where('group_chat_id', $latest_group_id_activities)
                                            ->get()->first()->group_chat_id;
            // return $group_chat_id;
            
            $messageGroupChat = MessageGroupChat::where('group_chat_id', $group_chat_id)
                    ->orderBy('updated_at', 'desc')
                    ->get();


            $chats = $messageGroupChat->map(function ($mgc) {
                return [
                    'chat_id' => $mgc->message_group_chat_id,
                    'sender_name' => $mgc->sender->first_name,
                    'sender_id' => $mgc->sender->user_id,
                    'chat_text' => $mgc->group_chat_text,
                    'chat_send_time' => $mgc->created_at,
                ];
            });

            $chatId = $latest_group_id_activities;

        }

        return response()->json([
            "chats" => $chats,
            "chat_id" => $chatId
        ]);
    }

    public function getListGroupMessage(User $user) {
        $userId = $user->user_id;
    
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
    
        // Ambil group chats yang dimiliki oleh user dengan relasi messageGroupChat dan chats
        $groupChats = $user->groupChats;   

        // return $groupChats;


        // Proses setiap group chat untuk mendapatkan chat terbaru
        $groupChatsWithLatestChat = $groupChats->map(function ($groupChat) {
            $latestChat = $groupChat->messageGroupChat->sortBy('created_at')->first();
    
            return [
                'group_chat_id' => $groupChat->group_chat_id,
                'group_chat_name' => $groupChat->group_chat_name, // Ganti sesuai nama kolom untuk nama group chat
                'latest_chat' => $latestChat->group_chat_text, // Ganti sesuai kolom untuk isi pesan
                'latest_time_chat' => $latestChat->created_at,
                'avatar' => '../../assets/images/avatars/t1.jpg',
            ];
        })->sortBy('latest_time_chat')->values();
        
        // Format respons JSON
        return response()->json([
            'user_id' => $user->user_id,
            'group_chats' => $groupChatsWithLatestChat,
            // 'chats' => $chats
        ]);
    }


    //Chat List of Group Chat by Id groupchat
    public function getGroupChatById($groupChatId) {

        $messageGroupChats = MessageGroupChat::where('group_chat_id', $groupChatId)->get(); // Ambil semua MessageGroupChat terkait
        

        // Ambil dan format semua chats dalam satu tingkat array
        $chats = $messageGroupChats->map(function ($message) {
                return [
                    "sender_id" => $message->sender_id,
                    "sender_name" => $message->sender->first_name,
                    "chat_id" => $message->message_group_chat_id,
                    "chat_text" => $message->group_chat_text,
                    "chat_send_time" => $message->created_at,
                    "avatar" => '../../assets/images/avatars/t1.jpg',
                ];
        })->sortByDesc('chat_send_time')->values();

        return response()->json([
            'chats' => $chats,
        ]);
    }

    public function getPrivateChatById(User $user, User $sender) {

        // return [
        //     $user,
        //     $sender
        // ];
        $messagePrivateChats = MessagePrivateChat::where('user_id', $user->user_id)->where('sender_id', $sender->user_id)->get();
        
        $chats = $messagePrivateChats->map(function ($message) {
            return [
                "sender_id" => $message->sender_id,
                "sender_name" => $message->sender->first_name,
                "chat_id" => $message->message_private_chat_id,
                "chat_text" => $message->private_chat_text,
                "chat_send_time" => $message->created_at,
                "avatar" => '../../assets/images/avatars/t1.jpg',
            ];
        })->sortBy('chat_send_time')->values();

        return response()->json([
            'chats' => $chats,
        ]);
    }

    
}
