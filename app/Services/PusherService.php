<?php


namespace App\Services;


use Pusher\Pusher;

class PusherService
{
    /**
     * @param $data
     * @throws \Pusher\PusherException
     */
    public static function trigger($data){

        // pusher
        $options = array(
            'cluster' => 'eu',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $pusher->trigger('my-channel', 'my-event', $data);
    }
}
