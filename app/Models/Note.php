<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const VISABILITY_SELECT = [
        'everyone' => 'Iedereen',
        'admins'   => 'Alleen leiding',
        'me'       => 'Enkel ik',
    ];

    public $table = 'notes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'userid_id',
        'note',
        'relationtype',
        'relationid',
        'visability',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function userid()
    {
        return $this->belongsTo(User::class, 'userid_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
