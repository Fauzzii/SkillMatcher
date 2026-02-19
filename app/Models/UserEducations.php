<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEducations extends Model
{
    use HasFactory;

    protected $table = 'user_educations';

    protected $fillable = [
        'user_id',
        'level',
        'institution_name',
        'graduation_year',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
