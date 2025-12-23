<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndustryRegistration extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_name',
        'economic_code',
        'industry_ministry_code',
        'industry_type',
        'contact_name',
        'contact_position',
        'mobile',
        'email',
        'province',
        'city',
        'address',
        'voltage_level',
        'demand_kw',
        'goals',
        'description',
    ];

    protected $casts = [
        'goals' => 'array',
    ];
}
