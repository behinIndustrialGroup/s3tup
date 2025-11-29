<?php

namespace Behin\SimpleWorkflowReport\Models;

use App\Models\InstallerApplication;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallerApplicationProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'installer_application_id',
        'title',
        'description',
        'image_path',
    ];

    public function installerApplication()
    {
        return $this->belongsTo(InstallerApplication::class);
    }
}
