<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory;

    protected $table = 'jobs';

    protected $fillable = [
        'company_id',
        'category',
        'title',
        'description',
        'salary',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function company()
    {
        return $this->belongsTo(Companies::class);
    }

    public function skills()
    {
        return $this->belongsToMany(skills::class, 'job_skills', 'job_id', 'skill_id')
            ->withPivot('category')
            ->withTimestamps();
    }

    public function applications()
    {
        return $this->hasMany(applications::class, 'job_id');
    }
}
