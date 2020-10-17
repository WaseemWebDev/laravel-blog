<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index()
    {
        return view('createblog');
    }
    public function uploadblog(Request $request)
    {
        $title =  $request->input("title");
        $description =  $request->input("description");
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);
        $imageName = time() . '.' . $request->image->extension();
        $imageUploaded =  $request->image->move(public_path('images'), $imageName);
        if ($imageUploaded) {
            $insertData =  DB::table('posts')->insert(
                ['title' => $title, 'description' => $description, 'image' => $imageName]
            );
            if ($insertData > 0) {
                return back()
                    ->with('success', 'You have successfully upload image.');
            }
        }
    }
    public function deletepost(Request $request)
    {
        $postId = $request->input("postid");
        $data = DB::table('posts')->where('id', '=', $postId)->delete();
        if ($data  > 0) {
            return back()
                ->with('success', 'You have successfully deleted post');
        }
    }
    public function readmore($id)
    {
        $data = DB::table('posts')->find($id);

        $comments = DB::table('comments')->where('post_id', '=', $id)->orderBy('id', 'DESC')->get();
        return view('readmore', ['post' => $data, 'comments' => $comments]);
    }
    public function addcomment(Request $req)
    {
        $commentValue =  $req->input("comment");
        $id = $req->input("id");

        $insertData =  DB::table('comments')->insert(
            ['comment' => $commentValue, 'post_id' => $id]
        );
        if ($insertData > 0) {
            return back()
                ->with('success', 'comment has been posted ',);
        }
    }
    public function searchpost(Request $req)
    {
        $data = "";
        $value = $req->get("value");
        $result = DB::table('posts')->where('title', 'LIKE', "%$value%")->get();

        foreach ($result as $val) {
            $data .= "<ul class='list-group'>";
            $data .= "<li class='list-group-item listdata' data-id='$val->id'>" . $val->title . "</li></ul>";
        }

        echo $data;
    }
}
