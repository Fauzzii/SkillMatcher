<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchResults extends Model
{
    use HasFactory;

    protected $table = 'match_results';

    protected $fillable = [
        'user_id',
        'job_id',
        'match_percentage',
        'recommendation_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job()
    {
        return $this->belongsTo(jobs::class);
    }
}
