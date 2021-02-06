<?php


namespace App\Repositories\Contracts;


interface UserRepositoryContract
{
    /**
     * @return mixed
     */
    public function all();

    /**
     * @param $user_name
     * @return mixed
     */
    public function create($user_name);

    /**
     * @param $user_name
     * @return mixed
     */
    public function findByUserName($user_name);

    /**
     * @return mixed
     */
    public function getUniqueUserName();


}
