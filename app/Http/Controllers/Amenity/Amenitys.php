<?php

namespace App\Http\Controllers\Amenity;

use App\Models\Post;
use App\Models\Role;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Amenity\Amenity;
use App\Http\Controllers\Controller;
use App\Models\Amenity_Group\Amenity_Group;

class Amenitys extends Controller
{
    public function index()
    {
        # count post comments 
        $comment = Role::withCount('permissions')->get();
        dd($comment);

        # delete post and comments will auto delete by post ID
        // $post = Post::findOrFail(1);
        // $ok = $post->comments()->delete();
        // $post->delete();
        
        // if($ok) {
        //     echo 'Ok deleted';
        // }

        
        $post = Post::find(1);
        $cmd1 = new Comment;
        $cmd2 = new Comment;
        $cmd1->comment = 'Testing  Comments A';
        $cmd2->comment = 'Testing Comments A';
        $in = $post->comments()->saveMany([$cmd1, $cmd2]);
        if($in) {
            echo 'OK insert';
        }
    }
}
