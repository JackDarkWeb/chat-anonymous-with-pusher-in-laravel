<?php


namespace App\Repositories\Contracts;


interface MessageRepositoryContract
{
    /**
     * @return mixed
     */
    public function all();

    /**
     * @param $user
     * @param $request
     * @return mixed
     */
    public function create($user, $request);
}
