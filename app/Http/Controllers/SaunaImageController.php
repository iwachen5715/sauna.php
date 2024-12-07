<?php

namespace App\Http\Controllers;

use App\Models\SaunaImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SaunaImageController extends Controller
{
    public function index()
    {
        $images = SaunaImage::all();
        return view('saunas.index', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('image')->store('sauna_images', 'public');

        SaunaImage::create([
            'title' => $request->title,
            'image_path' => $path,
        ]);

        return redirect()->route('saunas.index');
    }
}
