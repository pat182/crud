<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Albums extends Model
{
    use HasFactory;
    protected $table = 'albums';
    public $timestamps = false;
    protected $primaryKey = 'album_id';
    
    protected $fillable = [
        'artist_id',
        'album_title',
        'album_cover'
    ];
}
