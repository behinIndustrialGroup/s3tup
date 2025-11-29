<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallerApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'national_id',
        'phone',
        'province',
        'city',
        'description',
    ];

    public function profile()
    {
        return $this->hasOne(\Behin\SimpleWorkflowReport\Models\InstallerApplicationProfile::class);
    }

    public function projects()
    {
        return $this->hasMany(\Behin\SimpleWorkflowReport\Models\InstallerApplicationProject::class);
    }
}
