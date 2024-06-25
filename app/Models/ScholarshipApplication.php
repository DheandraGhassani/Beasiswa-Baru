<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScholarshipApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'scholarship_type_id',
        'period_id',
        'gpa',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scholarshipType()
    {
        return $this->belongsTo(ScholarshipType::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function documents()
    {
        return $this->hasMany(ScholarshipDocument::class, 'application_id');
    }
}
