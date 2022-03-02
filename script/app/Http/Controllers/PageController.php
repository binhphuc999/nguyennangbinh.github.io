<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use voku\helper\AntiXSS;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pages.index')->with('pages', Page::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.create');
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
            'slug' => 'required|unique:pages|alpha_dash',
            'content' => 'required|min:2',
            'status' => 'boolean|required',
        ]);

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



        $page = new Page();
        $page->title = $request->title;
        $page->status = $request->status;
        $page->content = $description;
        $page->slug = SlugService::createSlug(Page::class, 'slug', $request->title);
        $page->save();

        session()->flash('success', 'Page Created Successfuly');
        return redirect(route('pages.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show($page)
    {

        $page = Page::where("status", "=", 1)->where("slug", "=", $page)->first();

        return view('frontend.page', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('backend.pages.edit')->with('page', $page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {

        //dd($request);
        $request->validate([
            'title' => 'required|max:255|min:2',
            'slug' => 'required|alpha_dash|unique:pages,slug,' . $page->id,
            'content' => 'required|min:2',
            'status' => 'boolean|required',
        ]);


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

        

        $page->update([
            $page->title = $request->title,
            $page->status = $request->status,
            $page->content = $description,
            $page->slug = $request->slug
        ]);


        session()->flash('success', 'Page Updated Successfuly');
        return redirect(route('pages.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();

        session()->flash('success', 'Page Deleted Successfuly');

        return redirect(route('pages.index'));
    }


    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Page::class, 'slug', $request->title);

        return response()->json(['slug' => $slug]);
    }
}
