<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScholarshipDocument extends Model
{
    use HasFactory;

    protected $fillable = ['application_id', 'file_path'];

    public function scholarshipApplication()
    {
        return $this->belongsTo(ScholarshipApplication::class, 'application_id');
    }

    public function application()
    {
        return $this->belongsTo(ScholarshipApplication::class, 'application_id');
    }
}
