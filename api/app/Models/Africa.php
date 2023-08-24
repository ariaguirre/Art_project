<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Africa extends Model
{
    protected $table = 'africa';
    use HasFactory;
    protected $fillable = [
    'title', 'artistDisplayName', 'primaryImage', 'department', 'artistDisplayBio',
    'artistNationality', 'artistBeginDate', 'artistEndDate', 'artistWikidata_URL',
    'objectBeginDate', 'objectEndDate', 'dimensions', 'objectURL',
    ];
}
