<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DropFile extends Model
{
    use HasFactory;

    protected $fillable = ['drop_id', 'original_name', 'aws_path', 'size'];

    public function drop()
    {
        return $this->belongsTo(Drop::class);
    }
}
