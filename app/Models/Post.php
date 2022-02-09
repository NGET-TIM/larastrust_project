<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'roles';
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public static function boot() {
        parent::boot();
        self::deleting(function($post) {
            $post->comments()->each(function($comment) {
                $comment->delete();
            });
        });
    }
}
