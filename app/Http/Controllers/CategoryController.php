<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::all();
        return response()->view('dashboard.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return response()->view('dashboard.category.creat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // For Creat some Roles or saveing
        $validator = $request->validate([
            'title' => 'required|string|min:3|max:30|unique:categories,title'
        ]);


        // For save The chickBox as int
        if ($request->input('is_active') == 'on') {
            $active = true;
        } else {
            $active = false;
        }
        // For save data in table category
        $category = new Category([
            'title' => $request->input('title'),
            'is_active' => $active
        ]);
        $category->save();

        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $category = Category::findOrFail($id);

        return view('dashboard.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $validator = $request->validate([
            'title' => "required|string|min:3|max:30|unique:categories,title,$id"
        ]);

        // For save The chickBox as int
        if ($request->input('is_active') == 'on') {
            $active = true;
        } else {
            $active = false;
        }
        // For save data in table category
        $category = Category::findOrFail($id);
        $category->title = $request->input('title');
        $category->is_active = $active;
        $category->save();

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $category = Category::findOrFail($id);

        $isDeleted = $category->delete();
        if ($isDeleted) {
            return redirect()->route('category.index');
        }
    }
}
