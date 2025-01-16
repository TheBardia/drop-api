<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drop extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    public function files()
    {
        return $this->hasMany(DropFile::class);
    }
}
