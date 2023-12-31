<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages_';
    protected $fillable = ['content', 'name','userid','title'];
    use HasFactory;
}

