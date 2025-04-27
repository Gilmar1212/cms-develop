<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public static function createPost(array $data, int $authorId)
    {
        return self::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'slug' => String::slug($data['title']),
            'short-description' => $data['short-description'],
            'author_id' => $authorId,
            'status' => 'draft'
        ]);
    }

}
