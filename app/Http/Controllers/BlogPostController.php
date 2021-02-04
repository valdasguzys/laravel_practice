<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\User;

class BlogPostController extends Controller{
    // array imitates our model
    private $blogPosts = [
        ['id' => 1, 'title' => 'Title 1', 'text' => 'Some text 1'],
        ['id' => 2, 'title' => 'Title 2', 'text' => 'Some text 2']
    ];

    public function index(){
        // return $this->blogPosts;
        return view('blogposts', ['posts' => \App\Models\BlogPost::all()]); // MODEL::all() → SELECT ALL ROWS
    }

    // public function show($id){
    //     foreach($this->blogPosts as $blogPost){
    //         if($blogPost['id'] == $id){
    //             return $blogPost;
    //         }
    //     }
    // }
    public function show($id){
        return view('blogpost', ['post' => \App\Models\BlogPost::find($id)]);
    }


    public function store(Request $request){
        $this->validate($request, [
            // [Dėmesio] validacijoje unique turi būti nurodytas teisingas lentelės pavadinimas! Galime pažiūrėti, kas bus jei bus neteisingas
               'title' => 'required|unique:blog_posts,title|max:5',
               'text' => 'required',
           ]);
        $bp = new \App\Models\BlogPost();
        $bp->title = $request['title'];
        $bp->text = $request['text'];
        $bp->user_id = auth()->user()->id;

        // // primityvi validacija irgi gali būti taip padaryta
        // if($pb->title == NULL or $pb->text == NULL)
        //     return redirect('/laravel__practice/posts')->with('status_error', 'Post was not created!');

        return ($bp->save() !== 1) ? 
            redirect('/posts')->with('status_success', 'Post created!') : 
            redirect('/posts')->with('status_error', 'Post was not created!');
            // redirect('/laravel_practice/posts')->with('status_success', 'Post created!') : 
            // redirect('/laravel_practice/posts')->with('status_error', 'Post was not created!');
    }

    public function destroy($id){
        \App\Models\BlogPost::destroy($id);
        return redirect('/posts')->with('status_success', 'Post deleted!');
        // return redirect('/laravel_practice/posts')->with('status_success', 'Post deleted!');

    }

    public function update($id, Request $request){
    // [Dėmesio] validacijoje unique turi būti nurodytas teisingas lentelės pavadinimas!
    // galime pažiūrėti, kas bus jei bus neteisingas
        $this->validate($request, [
            // 'title' => 'required|unique:blog_posts,title|max:5',
            // leidzia updeitinti 'text' paliekant ta pati 'title'
            'title' => 'required|unique:blog_posts,title,'.$id.',id|max:5',
            'text' => 'required',
        ]);
        $bp = \App\Models\BlogPost::find($id);
        $bp->title = $request['title'];
        $bp->text = $request['text'];
        return ($bp->save() !== 1) ? 
            redirect('/posts/'.$id)->with('status_success', 'Post updated!') : 
            redirect('/posts/'.$id)->with('status_error', 'Post was not updated!');
            // redirect('/laravel_practice/posts/'.$id)->with('status_success', 'Post updated!') : 
            // redirect('/laravel_practice/posts/'.$id)->with('status_error', 'Post was not updated!');
    }

    public function storePostComment($id, Request $request){
        $this->validate($request, ['text' => 'required']);
        $bp = \App\Models\BlogPost::find($id);
        $cm = new \App\Models\Comment();
        $cm->text = $request['text'];
        $bp->comments()->save($cm); // priskiriame naują komentarą blogpostui
        return redirect()->back()->with('status_success', 'Comment added!');
    }
            


}




