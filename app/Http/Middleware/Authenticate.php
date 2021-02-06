<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\UserRepositoryContract;
use Closure;
use Illuminate\Support\Facades\Cookie;

class Authenticate
{
    protected $userRepository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->userRepository    = $userRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Cookie::has('user_name_remember')){

            $user_name = $this->userRepository->getUniqueUserName();

            $this->userRepository->create($user_name);

            $user_name_cookie = cookie('user_name_remember', $user_name);

            return redirect()->route('chat')->withCookie($user_name_cookie);
        }
        return $next($request);
    }
}
