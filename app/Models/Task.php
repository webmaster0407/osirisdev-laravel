<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'tasks';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'createduser_id',
        'assigneduser_id',
        'description',
        'completed',
        'relationtype',
        'relationid',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function createduser()
    {
        return $this->belongsTo(User::class, 'createduser_id');
    }

    public function assigneduser()
    {
        return $this->belongsTo(User::class, 'assigneduser_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
