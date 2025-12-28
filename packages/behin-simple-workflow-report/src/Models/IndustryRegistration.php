<?php

namespace Behin\SimpleWorkflowReport\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndustryRegistration extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'industry_registrations';

    protected $fillable = [
        'company_name',
        'economic_code',
        'province',
        'city',
        'address',
        'voltage_level',
        'demand_kw',
        'goals',
        'industry_ministry_code',
        'industry_type',
        'contact_name',
        'contact_position',
        'mobile',
        'email',
        'description',
    ];
}
