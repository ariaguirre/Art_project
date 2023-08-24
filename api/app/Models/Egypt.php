<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egypt extends Model
{
    protected $table = 'egypt';
    use HasFactory;
    protected $fillable = [
    'title', 'artistDisplayName', 'primaryImage', 'department', 'artistDisplayBio',
    'artistNationality', 'artistBeginDate', 'artistEndDate', 'artistWikidata_URL',
    'objectBeginDate', 'objectEndDate', 'dimensions', 'objectURL',
    ];
}
