<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;
    protected $table = 'artist';
    protected $primaryKey = 'artist_id';
    // const CREATED_AT = 'upload_date';
    // const UPDATED_AT = 'update_date';

    protected $fillable = [
        'name',
        'user_id'
    ];
}
