<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiBlogPostController extends Controller
{
 
    public function index()
    {
        return \App\Models\Blogpost::all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request){
        $data = $request->json()->all();
        $rules = [
            'title' => 'required|unique:blog_posts,title',
            'text' => 'required',
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            $bp = new \App\Models\BlogPost();
            $bp->title = $data['title'];
            $bp->text = $data['text'];
            return ($bp->save() !== 1) ? 
                response()->json(['success' => 'success'], 201) : 
                response()->json(['error' => 'saving to database was not successful'], 500)  ;
        } else {
            return $validator->errors()->all();
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id){
        return (\App\Models\Blogpost::destroy($id) == 1) ? 
            response()->json(['success' => 'success'], 200) : 
            response()->json(['error' => 'deleting from database was not successful'], 500);
    }

}
