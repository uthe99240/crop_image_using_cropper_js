<?php

namespace App\Http\Controllers;

use App\Models\CropImage;
use Illuminate\Http\Request;

class CropImageController extends Controller
{

    public function create()
    {
        return view('form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = public_path('upload/');
        !is_dir($path) &&
            mkdir($path, 0777, true);

        $image_parts      = explode(";base64,", $request->cropped_image_data);
        $image_type_aux   = explode("image/", $image_parts[0]);
        $image_type       = $image_type_aux[1];
        $image_base64     = base64_decode($image_parts[1]);
        $image_name       = uniqid() . '.png';
        $image_full_path  = $path . $image_name;
        file_put_contents($image_full_path, $image_base64);
        $image_name = '/upload' . '/' . $image_name;

        CropImage::create([
            'name' => $request->name,
            // 'path' => 'uploads/' . $image_name,
            'path' => $image_name
        ]);

        return redirect()->route('form.index');
    }

    public function index()
    {
        $images = CropImage::all();
        return view('index', compact('images'));
    }

    public function edit($id)
    {
        $image = CropImage::findOrFail($id);
        return view('edit', compact('image'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $image = CropImage::findOrFail($id);

        if ($request->file) {
            $path = public_path('upload/');
            !is_dir($path) &&
                mkdir($path, 0777, true);

            $image_parts      = explode(";base64,", $request->cropped_image_data);
            $image_type_aux   = explode("image/", $image_parts[0]);
            $image_type       = $image_type_aux[1];
            $image_base64     = base64_decode($image_parts[1]);
            $image_name       = uniqid() . '.png';
            $image_full_path  = $path . $image_name;
            file_put_contents($image_full_path, $image_base64);
            $image_name = '/upload' . '/' . $image_name;

            $image->update([
                'name' => $request->name,
                'path' => $image_name
            ]);
        } else {
            $image->update([
                'name' => $request->name
            ]);
        }


        try {
            $image->update($request->all());
        } catch (\Exception $exception) {
            return redirect()->back()->withInput();
        }

        return redirect()->route('form.index')->with('success', 'Image details updated successfully.');
    }

    public function destroy($id)
    {
        $image = CropImage::findOrFail($id);
        $image->delete();
        return redirect()->route('form.index')->with('success', 'Image deleted successfully.');
    }
}
