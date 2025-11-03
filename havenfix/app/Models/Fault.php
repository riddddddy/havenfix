<?php

namespace App\Models;

use Soap\Url;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fault extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'item',
        'image',
        'description',
        'status',
        'level',
        'block'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workSummaries(){
        return $this->hasMany(WorkSummary::class);
    }
}
