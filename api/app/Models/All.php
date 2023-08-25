<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class All extends Model
{
    protected $table = 'all';
    use HasFactory;
    protected $fillable = [
    'title', 'artistDisplayName', 'primaryImage', 'department', 'artistDisplayBio', 'isHighlight',
    'artistNationality', 'artistBeginDate', 'artistEndDate', 'artistWikidata_URL',
    'objectBeginDate', 'objectEndDate', 'dimensions', 'objectURL',
    ];
}
