<?php


namespace App\Repositories;


use App\Repositories\Contracts\UserRepositoryContract;
use App\User;

class UserRepository implements UserRepositoryContract
{

    /**
     * @return mixed
     */
    public function all()
    {
        return User::all();
    }


    /**
     * @param $user_name
     * @return mixed|void
     */
    public function findByUserName($user_name)
    {
        return User::where('user_name', $user_name)->first();
    }



    public function create($user_name)
    {
        return User::create([
            'user_name' => $user_name
        ]);
    }

    /**
     * @return string
     */
    public function getUniqueUserName()
    {
        $user_name = "anonymous_".mt_rand(1, 9999);

        if(User::where('user_name', $user_name)->count()!= 0)
        {
            return $this->getUniqueUserName();
        }
        return $user_name;
    }
}
