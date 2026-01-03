<?php

namespace Behin\SimpleWorkflow\Models\Core;

use Behin\SimpleWorkflow\Controllers\Core\FormController;
use Behin\SimpleWorkflow\Controllers\Core\VariableController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Cases extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    public $table = 'wf_cases';


    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }
    protected $fillable = [
        'process_id',
        'number',
        'name',
        'creator'
    ];

    public function whereIs(){
        $childCaseId = Cases::where('number', $this->number)->pluck('id')->toArray();
        $rows = Inbox::WhereIn('case_id', $childCaseId)->whereNotIn('status', ['done', 'doneByOther', 'canceled'])->get();

        return $rows;
    }

    public function variables()
    {
        return VariableController::getVariablesByCaseId($this->id);
    }

    public function process(){
        return $this->belongsTo(Process::class, 'process_id');
    }

}

