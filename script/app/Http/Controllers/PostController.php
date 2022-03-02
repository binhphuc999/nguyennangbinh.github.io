<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use voku\helper\AntiXSS;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        if ($categories->count() > 0) {
            return view('backend.posts.create')->with('categories', $categories);
        } else {
            return redirect(route('categories.index'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255|min:2',
            'category_id' => 'required',
            'slug' => 'required|unique:posts|alpha_dash',
            'content' => 'required|min:2',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'boolean|required',
            'description' => 'required|min:2|max:200|string',
        ]);


        $file = $request->thumbnail;
        $thumbnail = time() . '-' . $file->getClientOriginalName();
        $file->move('./uploads/', $thumbnail);
        $thumbnail = '/uploads/' . $thumbnail;



        $description = $request->input('content');
        $dom = new \DomDocument();
        @$dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {

            $data = $img->getAttribute('src');

            if (strpos($data, ';') !== false) {

                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);

                $image_name = "/uploads/" . time() . $key . '.png';
                $path = "." . $image_name;

                file_put_contents($path, $data);

                $img->removeAttribute('data-filename');
                $img->removeAttribute('src');
                $img->setAttribute('src', asset($image_name));
            }
        }
        $description = $dom->saveHTML();

        $antiXss = new AntiXSS();

        $antiXss->removeEvilAttributes(array('style'));

        $antiXss->removeEvilHtmlTags(array('iframe'));

        $description = $antiXss->xss_clean($description);


        $post = new Post();
        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->status = $request->status;
        $post->image = $thumbnail;
        $post->content = $description;
        $post->description = $request->description;
        $post->slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        $post->save();

        session()->flash('success', 'Post Created Successfuly');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        $post = Post::where('slug', $post)->first();

        if ($post['status'] == 1) {

            $views = $post['views'] + 1;

            $post->update([
                $post->views = $views
            ]);

            return view('frontend.post', compact("post"));
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('backend.posts.edit')->with('categories', Category::all())->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255|min:2',
            'category_id' => 'required',
            'slug' => 'required|alpha_dash|unique:posts,slug,' . $post->id,
            'content' => 'required|min:2',
            'thumbnail' => 'image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'boolean|required',
            'description' => 'required|min:2|max:200|string',
        ]);


        if ($request->has('thumbnail')) {

            $file = $request->thumbnail;
            $thumbnail = time() . '-' . $file->getClientOriginalName();
            $file->move('./uploads/', $thumbnail);
            $post->image = '/uploads/' . $thumbnail;
        }




        $description = $request->input('content');
        $dom = new \DomDocument();
        @$dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            $data = $img->getAttribute('src');

            if (strpos($data, ';') !== false) {
                // explodable
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);

                $image_name = "/uploads/" . time() . $key . '.png';
                $path =  "." . $image_name;

                file_put_contents($path, $data);

                $img->removeAttribute('data-filename');
                $img->removeAttribute('src');
                $img->setAttribute('src', asset($image_name));
            }
        }
        $description = $dom->saveHTML();

        $antiXss = new AntiXSS();

        $antiXss->removeEvilAttributes(array('style'));

        $antiXss->removeEvilHtmlTags(array('iframe'));

        $description = $antiXss->xss_clean($description);


        $post->update([
            $post->title = $request->title,
            $post->category_id = $request->category_id,
            $post->status = $request->status,
            $post->image = $post->image,
            $post->content = $description,
            $post->description = $request->description,
            $post->slug = $request->slug
        ]);


        session()->flash('success', 'Post Updated Successfuly');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        session()->flash('success', 'Post Deleted Successfuly');

        return redirect(route('posts.index'));
    }


    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);

        return response()->json(['slug' => $slug]);
    }
}
