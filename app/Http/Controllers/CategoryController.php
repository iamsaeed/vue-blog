<?php

namespace App\Http\Controllers;

use App\Category;
use App\Traits\Search;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use Search;

    public function computed()
    {
        return view('computed');
    }

    public function index()
    {
        return view('categories.index');
    }

    public function get(Request $request)
    {
        $name = $request->input('name') ?: '';
        $description = $request->input('description') ?: '';

        $categories = Category::search('name', $name)
            ->search('description', $description)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return response()->json([
            'categories' => $categories
        ], 200);
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
                'name' => 'required|unique:categories,name',
                'description' => 'required',

            ]);

            $message = 'Category added!';
        } else {
            $request->validate([
                'name' => 'required|unique:categories,name,'.$request->input('id'),
                'description' => 'required',

            ]);
            $message = 'Category updated!';
        }

        $category = Category::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);

        return response()->json([
            'category' => $category,
            'message' => $message
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $category = Category::find($request->input('id'));
        $category->delete();

        return response()->json([
            'message' => 'Category deleted!'
        ], 200);
    }
}
