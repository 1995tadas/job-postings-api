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
        $posting = Posting::find($id);
        if (!$posting) {
            return response()->json(['error' => 'Record not Found'], 404);
        }

        $postingAuthor = Posting::where('user_id', auth()->user()->id)->find($id);
        if (!$postingAuthor) {
            return response()->json(['error' => 'You are not an author'], 401);
        }

        return $next($request);
    }
}
