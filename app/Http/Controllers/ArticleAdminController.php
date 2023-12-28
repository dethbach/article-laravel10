<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Intervention\Image\Image as InterventionImage;

class ArticleAdminController extends Controller
{
    public function categories()
    {
        $datas = Category::orderBy('name', 'asc')->get();
        return view('admin.article.category', compact('datas'));
    }

    public function categoriesPost($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $datas = Article::with('articleCategory')->where('category_id', $category->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.article.article', compact('datas', 'category'));
    }

    public function authorPost($id)
    {
        $category = User::where('id', $id)->first();
        $datas = Article::where('author_id', $category->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.article.article', compact('datas', 'category'));
    }

    public function authorPostPublish($id)
    {
        $category = User::where('id', $id)->first();
        $datas = Article::where('author_id', $category->id)->where('status', true)->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.article.article', compact('datas', 'category'));
    }

    public function authorPostDraft($id)
    {
        $category = User::where('id', $id)->first();
        $datas = Article::where('author_id', $category->id)->where('status', false)->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.article.article', compact('datas', 'category'));
    }

    public function categoriesStore(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'unique:' . Category::class],
        ]);

        $lower = strtolower($request->name);
        $slug = Str::replace(' ', '-', $lower);

        $store = Category::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        if ($store) {
            return back()->with('success', 'Data successfully inserted');
        } else {
            return back()->with('error', 'Error: Data could not be inserted. Please check your input and try again.');
        }
    }

    public function categoriesDelete($id)
    {
        $posts = Article::where('category_id', $id)->delete();
        $destroying = Category::where('id', $id)->delete();

        if ($destroying) {
            return back()->with('success', 'Data successfully deleted');
        } else {
            return back()->with('error', 'Error: Data could not be deleted. Please check your input and try again.');
        }
    }

    public function post()
    {
        $category = null;
        $datas = Article::with('articleUser', 'articleCategory')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.article.article', compact('datas', 'category'));
    }

    public function postSearch(Request $request)
    {
        $category = null;
        $keyword = $request->searchArticle;
        $datas = Article::with('articleUser', 'articleCategory')
            ->where('title', 'like', '%' . $keyword . '%')
            ->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.article.article', compact('datas', 'category', 'keyword'));
    }

    public function write()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $cities = City::orderBy('name', 'asc')->get();
        return view('admin.article.write', compact('categories', 'cities'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'unique:' . Article::class],
            'thumbnail' => ['file', 'mimes:jpg,png,jpeg'],
            'content' => ['required']
        ]);

        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $request->title);

        if ($request->publishNow) {
            $status = true;
        } else {
            $status = false;
        }

        // Prepare common data
        $commonData = [
            'category_id' => $request->category,
            'city_id' => null,
            'author_id' => Auth::user()->id,
            'title' => $request->title,
            'lead' => $request->lead,
            'body' => $request->content,
            'slug' => $slug,
            'meta_title' => $request->metaTitle,
            'meta_description' => $request->metaDesc,
            'status' => $status,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        if ($request->duplicate) {
            $cities = City::get();
            $articlesToStore = [];
            $uploadedImage = $request->file('thumbnail');

            foreach ($cities as $city) {
                $cityName = $city->name;
                $title = $request->title . ' ' . $cityName;
                $newSlug = preg_replace('/[^A-Za-z0-9\-]/', '-', $city->name);
                $newthumbnailName = time() . '-' . $slug . '-' . $newSlug . '.' . $request->thumbnail->extension();

                // Clone the original image for each city
                $image = Image::make($uploadedImage); // Create a new instance

                // Resize and add text to the image
                $image = $this->addTextToImage($image, $title);

                // Save the resulting image for each city
                $image->save(public_path('storage/thumbnail-article/' . $newthumbnailName));

                $articlesToStore[] = array_merge($commonData, [
                    'city_id' => $city->id,
                    'title' => $title,
                    'slug' => $slug . '-' . $newSlug,
                    'thumbnail' => $newthumbnailName,
                ]);
            }

            Article::insert($articlesToStore);
        } else {

            $uploadedImage = $request->file('thumbnail');
            $image = Image::make($uploadedImage);
            $image->resize(300, 200)->encode('jpg', 80);;

            $newthumbnailName = time() . '-' . $slug . '.' . $request->thumbnail->extension();
            // Save the resulting image for each city
            $image->save(public_path('storage/thumbnail-article/' . $newthumbnailName));

            $articlesToStore = array_merge($commonData, [
                'thumbnail' => $newthumbnailName,
            ]);

            Article::create($articlesToStore);
        }

        return redirect('/admin/posts')->with('success', 'Data successfully inserted');
    }

    // Function to add text to an image and return the modified image
    private function addTextToImage($image, $text)
    {
        $image->resize(300, 200)->encode('jpg', 80);;
        $fontSize = 20;
        // Calculate the maximum width for text wrapping
        $maxWidth = $image->width() - 20; // Adjust the padding as needed

        // Split the text into lines to fit the maximum width
        $lines = wordwrap($text, 30, "\n", true);

        // Calculate the height of the entire text block
        $lineHeight = $fontSize * 1.5; // Adjust line height as needed
        $totalHeight = count(explode("\n", $lines)) * $lineHeight;

        // Calculate the Y-coordinate for vertical centering
        $y = ($image->height() - $totalHeight) / 2;

        foreach (explode("\n", $lines) as $line) {
            $image->text($line, $image->width() / 2, $y, function ($font) use ($fontSize) {
                $font->file(public_path('storage/font/Roboto/Roboto-Black.ttf'));
                $font->size($fontSize);
                $font->color('#ffffff'); // Set the font color
                $font->align('center');
            });

            $y += $lineHeight;
        }

        return $image;
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => [
                'required',
                Rule::unique('articles')->ignore($id),
            ],
            'content' => ['required']
        ]);

        $slug = preg_replace('/[^A-Za-z0-9\-]/', '-', $request->title);

        $update = Article::where('id', $id)->update([
            'category_id' => $request->category,
            'title' => $request->title,
            'lead' => $request->lead,
            'body' => $request->content,
            'slug' => $slug,
            'meta_title' => $request->metaTitle,
            'meta_description' => $request->metaDesc,
        ]);

        if ($update) {
            return redirect('/admin/posts')->with('success', 'Data successfully inserted');
        } else {
            return back()->with('error', 'Error: Data could not be inserted. Please check your input and try again.');
        }
    }

    public function updateThumbnail(Request $request, $id)
    {
        $this->validate($request, [
            'thumbnail' => ['file', 'mimes:jpg,png,jpeg'],
        ]);

        $data = Article::where('id', $id)->first();
        $newthumbnailName = time() . '-' . $data->slug . '.' . $request->thumbnail->extension();
        $request->thumbnail->move(public_path('storage/thumbnail-article'), $newthumbnailName);

        $update = Article::where('id', $id)->update([
            'thumbnail' => $newthumbnailName
        ]);

        if ($update) {
            return back()->with('success', 'Data successfully updated');
        } else {
            return back()->with('error', 'Error: Data could not be updated. Please check your input and try again.');
        }
    }

    public function show($slug)
    {
        $data = Article::with('articleUser')->where('slug', $slug)->first();
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.article.detail', compact('data', 'categories'));
    }

    public function status($id)
    {
        $data = Article::where('id', $id)->first();

        if ($data->status == true) {
            $update = Article::where('id', $id)->update(['status' => false]);
            if ($update) {
                return back()->with('success', 'Data successfully updated');
            } else {
                return back()->with('error', 'Error: Data could not be updated. Please check your input and try again.');
            }
        } else {
            $update = Article::where('id', $id)->update(['status' => true]);
            if ($update) {
                return back()->with('success', 'Data successfully updated');
            } else {
                return back()->with('error', 'Error: Data could not be updated. Please check your input and try again.');
            }
        }
    }

    public function destroy(Request $request)
    {
        $destroyer = Article::where('id', $request->articleId)->delete();
        if ($destroyer) {
            return redirect('/admin/posts')->with('success', 'Data successfully deleted');
        } else {
            return back()->with('error', 'Error: Data could not be deleted. Please check your input and try again.');
        }
    }
}
