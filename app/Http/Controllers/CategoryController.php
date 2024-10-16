<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $categories = (new Category())->storeCategory($request);
            DB::commit();
            return redirect()->route('categories.index')->with('success', 'Category created successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Category store failed', [
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'Failed to create product: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            DB::beginTransaction();
            (new Category())->updateCategory($request, $category);
            DB::commit();
            return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Category store failed', ['error' => $th->getMessage()]);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            DB::beginTransaction();
            (new Category())->deleteCategory($category);
            DB::commit();
            return redirect()->route('categories.index')->with('success', 'deleted succesfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Deleted failed', ['error' => $th->getMessage()]);
            return redirect()->back();
        }
    }
}
