<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ShipyardController extends Controller
{
    public function admin()
    {
        $datas = Article::with('articleUser', 'articleCategory')->orderBy('created_at', 'desc')->take(5)->get();
        $topAuthor = User::withCount('articles') // Count the number of articles for each user
            ->orderByDesc('articles_count') // Order by the number of articles in descending order
            ->take(3) // Take only the top 3
            ->get();
        return view('admin.index', compact('datas', 'topAuthor'));
    }

    public function user()
    {
        return view('user.index');
    }

    public function article(Request $request)
    {

        $headerright = Article::with('articleCategory')->where('status', true)
            ->take(1)
            ->orderBy('created_at', 'desc')
            ->get();
        $headerleft = Article::with('articleCategory')->where('status', true)
            ->skip(1)
            ->take(2)
            ->orderBy('created_at', 'desc')
            ->get();
        if ($request->search) {
            $finder = $request->search;
            $datas = Article::with('articleCategory', 'articleUser')->where('status', true)->where('title', 'like', '%' . $request->search . '%')->orderBy('created_at', 'Desc')->paginate(10);
        } else {
            $finder = null;
            $datas = Article::with('articleCategory', 'articleUser')->where('status', true)->skip(3)->orderBy('created_at', 'desc')->paginate(10);
        }
        return view('article.index', compact('headerright', 'headerleft', 'finder', 'datas'));
    }

    public function slug($slug)
    {
        $data = Article::with('articleCity', 'articleUser')->where('slug', $slug)->first();
        $readmore = Article::with('articleUser')->where('status', true)->where('id', '!=', $data->id)->orderBy('updated_at', 'desc')->take(5)->get();
        $anotherContent = Article::with('articleUser')->where('status', true)->where('id', '!=', $data->id)->inRandomOrder()->limit(5)->get();
        return view('article.read', compact('data', 'readmore', 'anotherContent'));
    }

    public function ask(Request $request)
    {
        $cleanString = preg_replace('/[^a-zA-Z0-9_]/', '%20', $request->questions);
        $url = 'https://wa.me/6281225113000/?text=' . $cleanString;
        return redirect()->away($url);
    }
}
