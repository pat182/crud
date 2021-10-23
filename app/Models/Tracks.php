<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Tracks extends Model
{
    use HasFactory;

    protected $table = "tracks";
    protected $primaryKey = "track_id";
    public $timestamps = false;
    protected $fillable = [
        'artist_id',
        'album_id',
        'track_name',
        'mp3',
        'lyrics'
    ];
}
