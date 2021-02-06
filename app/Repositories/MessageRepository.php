<?php


namespace App\Repositories;


use App\Message;
use App\Repositories\Contracts\MessageRepositoryContract;

class MessageRepository implements MessageRepositoryContract
{
    /**
     * @return mixed|void
     */
    public function all()
    {
        return Message::with('user')
                        //->latest()
                        ->get()
                        ->map(function ($message){

                            return (object)[
                                'user_name' => $message->user->user_name,
                                'body'      => $message->body,
                                'created_at' => $message->format_date
                            ];
                        });
    }

    /**
     * @param $user
     * @param $request
     * @return mixed
     */
    public function create($user, $request)
    {
        return $user->messages()->create($request->all());
    }
}
