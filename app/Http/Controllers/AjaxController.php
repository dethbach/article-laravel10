<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function categoryPost($id)
    {
        $data = Article::where('category_id', $id)->count();
        return response()->json($data);
    }

    public function userPost($id)
    {
        $data = Article::where('author_id', $id)->where('status', true)->count();
        return response()->json($data);
    }

    public function userDraft($id)
    {
        $data = Article::where('author_id', $id)->where('status', false)->count();
        return response()->json($data);
    }
}
