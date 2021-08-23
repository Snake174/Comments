<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use \App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments = DB::table('comments')
            ->limit(3)
            ->get();

        $sliderComments = Comment::inRandomOrder()
            ->limit(5)
            ->get();

        return view('welcome', [
            'comments' => $comments,
            'sliderComments' => $sliderComments,
        ]);
    }

    public function showMore(Request $request)
    {
        if ($request->ajax())
        {
            $countShow = $request->input('count_show');
            $countAdd = $request->input('count_add');

            $comments = DB::table('comments')
                ->offset($countShow)
                ->limit($countAdd)
                ->get();

            if ($comments->count() == 0)
            {
                return response()->json([
                    'success' => '',
                    'data' => ''
                ]);
            }

            $data = '';

            foreach ($comments as $comment)
            {
                $data .= "<div class='card' data-id='{$comment->author}'>";
                $data .= '<div class="card-body">';
                $data .= "<h5 class='card-title'>{$comment->author}</h5>";
                $data .= "<h6 class='card-subtitle mb-2 text-muted'>{$comment->created_at}</h6>";
                $data .= "<p class='card-text'>{$comment->comment}</p>";
                $data .= '</div>';
                $data .= '</div>';
            }

            return response()->json([
                'success' => 'ok',
                'data' => $data
            ]);
        }
    }

    public function addComment(Request $request)
    {
        if ($request->ajax())
        {
            $this->authorize('create', Comment::class);

            $comment = new Comment;
            $comment->author = Auth::user()->name;
            $comment->comment = htmlspecialchars($request->input('comment'));
            $comment->save();

            $data = "<div class='card' data-id='{$comment->author}'>";
            $data .= '<div class="card-body">';
            $data .= "<h5 class='card-title'>{$comment->author}</h5>";
            $data .= "<h6 class='card-subtitle mb-2 text-muted'>{$comment->created_at}</h6>";
            $data .= "<p class='card-text'>{$comment->comment}</p>";
            $data .= '</div>';
            $data .= '</div>';

            return response()->json([
                'success' => 'ok',
                'data' => $data
            ]);
        }
    }
}
