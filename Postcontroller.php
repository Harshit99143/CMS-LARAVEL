<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;


class Postcontroller extends Controller
{
    public function create(){
        return view('admin.post.addPost');
    }
    public function store(Request $request){
        
        $validator = Validator::make($request->all(), [
            'title'  => 'required',
            'section_title'  => 'required',
    ]);
    if($validator->fails()){
        $success=0;
        return  back()->withErrors($validator)->withInput();
    } else {
        if($request->image){
            $filename = $this->fileUpload($request,'image','');
    }
    $data = array(
        'page_title'  => $request->page_title,
        'section_title' => $request->section_title,
        'title' => $request->title,
        'description' => $request->description,
        'image' => $filename,
    );
    $post= Post::create($data);
    if($post){
        return redirect()->route('post-show')->with(['message'=>'Post Successfully inserted']);
    }else{
        return back()->with(['message'=>'Something Wrong']);
    }
    }
    }
}
