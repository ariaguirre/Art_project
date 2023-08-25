<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Islamic extends Model
{
    protected $table = 'islamic';
    use HasFactory;
    protected $fillable = [
        'title', 'artistDisplayName', 'primaryImage', 'department', 'artistDisplayBio', 'isHighlight',
        'artistNationality', 'artistBeginDate', 'artistEndDate', 'artistWikidata_URL',
        'objectBeginDate', 'objectEndDate', 'dimensions', 'objectURL',
        ];
}
