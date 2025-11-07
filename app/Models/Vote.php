<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'option_id',
        'ip_address',
    ];

    // Optional: if your table name is not 'votes', define it
    // protected $table = 'votes';
    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
