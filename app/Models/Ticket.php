<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';


    protected $fillable = [
        'title',
        'description',
        'state',
        'category',
        'priority',
        'attachment'

    ];

    public $timestamps = true;

    protected $attributes = [
        'state' => 'Open',
        'priority' => 'Medium',
    ];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
