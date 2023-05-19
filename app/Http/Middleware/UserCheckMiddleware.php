<?php

namespace App\Http\Middleware;

use App\Models\Article;
use App\Models\Task;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       $task_id = $request->id;
       $task = Task::query()->where('id','=',$task_id)->first();

       if($task === null){
           return redirect()->route('main');
       }

       if(auth()->user()->id !== $task->author_id and auth()->user()->role !=='admin'){
           return  redirect()->route('main');
       }

        return $next($request);
    }
}
