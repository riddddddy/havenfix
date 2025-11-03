<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkSummary extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'remarks', 'user_id', 'fault_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function fault(){
        return $this->belongsTo(Fault::class);
    }


}
