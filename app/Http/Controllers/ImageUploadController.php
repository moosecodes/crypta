<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ImageUploadController extends Controller
{ 
    public function __invoke(Request $request)
    {
        $path = '';
        
        if($request->image && $request->file('image')->isValid()) {
            $path = $request->image->store('images');
            // Cache::store('redis')->put('current_image_name', $path, 600); // 10 Minutes
            Redis::set('current_image_name', $path, 600);
            // return Cache::store('redis')->get('current_image_name');
            return Redis::get('current_image_name');
        }

        return 'image upload controller';
    }
}
