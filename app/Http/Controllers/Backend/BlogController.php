<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;

class BlogController extends Controller
{



    public function slider(){

        // $sliders = Blog::with('category')->paginate(30);
          // Retrieve all categories with their associated blog posts
    $categoriesWithBlogs = Category::with('blogs')->get();
        $categories = Category::all();

        return view('slider', compact('categories', 'categoriesWithBlogs'));
    }

    public function index(Request $request)
    {
        $blogs = Blog::paginate(10);  
        if ($request->ajax()) {
            $view = view('data', compact('blogs'))->render();  
            return response()->json(['html' => $view]);
       }  
        return view('blogs', compact('blogs'));
    }


 public function filterSliders(Request $request)
    {
        $searchTerm = $request->input('title');
        $categoryId = $request->input('category_id');
    
        // Query the database to filter sliders by title and category
        $query = Blog::query();
    
        if ($searchTerm) {       
            $query->whereHas('category', function ($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm . '%');
            });
        }
    
        if ($categoryId) {
            // Use the category relationship to filter by category
            $query->whereHas('category', function ($query) use ($categoryId) {
                $query->where('id', $categoryId);
            });
        }
    
        $sliders = $query->get();

       
        // Return the filtered sliders as JSON
        return response()->json(['sliders' => $sliders]);
    }
}
