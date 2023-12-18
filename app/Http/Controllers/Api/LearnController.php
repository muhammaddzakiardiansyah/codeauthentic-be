<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LearnResource;
use App\Models\Learn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LearnController extends Controller
{
    public function index() {
        $learning = Learn::latest()->paginate(8);
        return new LearnResource(true, 'Request has successed!', $learning);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'video' => 'required',
            'description' => 'required',
        ]);

        if($validator->fails()) 
        {
            return response()->json($validator->errors(), 422);
        }

        $vidio = $request->file('video');
        $vidio->storeAs('/public/vidio-learn', $vidio);

        $learn = Learn::create([
            'title' => $request->title,
            'video' => $vidio,
            'description' => $request->description,
        ]);

        return new LearnResource(true, 'Success Created!', $learn);
    }
}
