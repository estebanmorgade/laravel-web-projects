<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category){
        return view('projects.index', [
            'category' => $category,
            'projects' => $category->projects()->with('category')->latest()->paginate()
        ]);
    }
}
