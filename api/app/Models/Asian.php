<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asian extends Model
{
    protected $table = 'asian';
    use HasFactory;
    protected $fillable = [
    'title', 'artistDisplayName', 'primaryImage', 'department', 'artistDisplayBio',
    'artistNationality', 'artistBeginDate', 'artistEndDate', 'artistWikidata_URL',
    'objectBeginDate', 'objectEndDate', 'dimensions', 'objectURL',
    ];
}
