<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Houses extends Model
{
    use HasFactory;
    protected $table = 'houses';
    public function user()
    {
        $this->belongsTo('\Models\User', 'user_id', 'id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'title', 'price', 'home_space', 'number_of_rooms', 'number_of_entrances',
        'cladding_status', 'intermediary', 'floor', 'directione',
        'description', 'image', 'city', 'region', 'detailed_address', 'offer_type', 'user_id'
    ];
}
