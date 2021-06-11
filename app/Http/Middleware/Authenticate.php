<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Helpers\Helper;
use App\Traits\ResponseService;
use Firebase\JWT\JWT;

class Authenticate
{
    use ResponseService;
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->header('Authorization')) {
            try {
                if (Helper::decodeJwt($request->header('Authorization'))) {
                    return $next($request);
                };
            } catch (\Exception $err) {
                return $this->unauthorized([
                    'message' => $err->getMessage()
                ]);
            }
        }

        return $this->unauthorized([
            'message' => 'Insert token.'
        ]);
    }
}
