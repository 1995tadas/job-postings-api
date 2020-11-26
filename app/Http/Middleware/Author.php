<?php

namespace App\Http\Middleware;

use App\Models\Posting;
use Closure;
use Illuminate\Http\Request;

class Author
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $id = $request->route('id');
        $posting = Posting::where('user_id', auth()->user()->id)->find($id);
        if (!$posting) {
            return redirect()->back();
        }

        return $next($request);
    }
}
