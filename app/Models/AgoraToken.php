<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgoraToken extends Model
{
    protected $table = "agora_tokens";
    protected $fillable = ['token', 'status'];
}
