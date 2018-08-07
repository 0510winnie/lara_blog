<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RecordLastActivedTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //如果是登錄用戶的話
        if(Auth::check()){
          //紀錄最後登錄時間
          Auth::user()->recordLastActivedAt();
        }

        return $next($request);
    }
}
