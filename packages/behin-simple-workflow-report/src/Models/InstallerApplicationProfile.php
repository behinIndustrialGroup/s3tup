<?php

namespace Behin\SimpleWorkflowReport\Models;

use App\Models\InstallerApplication;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallerApplicationProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'installer_application_id',
        'summary',
    ];

    public function installerApplication()
    {
        return $this->belongsTo(InstallerApplication::class);
    }
}
