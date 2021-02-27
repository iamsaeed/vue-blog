<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blogs.index');
    }

    public function get(Request $request)
    {
        $blogs = Blog::with(['category', 'tags'])->get();

        return response()->json(['blogs' => $blogs, 'message' => null], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if(!$request->input('id'))
        {
            $request->validate([
                'name' => 'required|unique:blogs,name',
                'slug' => 'required',
                'description' => 'required',
                'category_id' => 'required',

            ]);

            $message = 'Blog added!';
        } else {
            $request->validate([
                'name' => 'required|unique:blogs,name,'.$request->input('id'),
                'slug' => 'required',
                'description' => 'required',
                'category_id' => 'required',

            ]);
            $message = 'Blog updated!';
        }

        DB::beginTransaction();

        $blog = Blog::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
                'category_id' => $request->input('category_id'),
                'description' => $request->input('description'),
            ]);

        if($request->tags) $blog->tags()->sync($request->tags);

        DB::commit();

        return response()->json([
            'blog' => $blog,
            'message' => $message
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
