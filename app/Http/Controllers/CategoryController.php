<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{

    // Lists all categories with their board counts
    public function index()
    {

        $categories = Category::query()
            ->withCount('boards')
            ->orderBy('created_at', 'desc')
            ->get();

        // Logic to list all categories
        return view('categories.index', [
            'categories' => $categories,
        ]);
    }

    // Displays a single category with its boards
    public function show(Category $category)
    {
        $category->load('boards');

        // Logic to display a single category
        return view('categories.show', [
            'category' => $category,
            'boards' => $category->boards,
        ]);
    }
}
