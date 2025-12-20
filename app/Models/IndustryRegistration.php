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
        'ceo_firstname',
        'ceo_lastname',
        'ceo_mobile',
        'representative_fullname',
        'representative_mobile',
        'province',
        'address',
        'requested_capacity',
        'description',
    ];
}
