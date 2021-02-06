<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\MessageRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Services\PusherService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Pusher\Pusher;

class ChatController extends Controller
{
    protected $messageRepository;
    protected $userRepository;

    public function __construct(MessageRepositoryContract $messageRepository, UserRepositoryContract $userRepository)
    {
        $this->middleware('auth');

        $this->messageRepository = $messageRepository;

        $this->userRepository    = $userRepository;
    }

    /**
     * @return Response
     */
    public function index(){

        $messages = $this->messageRepository->all();

        $users    = $this->userRepository->all();

        return response()->view('welcome',[
            'messages' => $messages,
            'users'    => $users
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     * @throws \Pusher\PusherException
     */
    public function sendMessage(Request $request){

        if ($request->ajax()){

            $user_name = Cookie::get('user_name_remember');

            $user = $this->userRepository->findByUserName($user_name);

            $message = $this->messageRepository->create($user, $request);

            //$messages = $this->messageRepository->all();

            PusherService::trigger(['user_name' => $message->user->user_name, 'body' => $message->body, 'created_at' => $message->format_date]);

            return response()->json(['success' => true], 200);
        }
        return back();
    }
}
