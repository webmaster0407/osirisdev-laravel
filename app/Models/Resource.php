<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const TYPE_SELECT = [
        'vehicle' => 'Voertuig',
        'tent'    => 'Tent',
        'box'     => 'Koffer',
        'other'   => 'Andere',
    ];

    public $table = 'resources';

    public static $searchable = [
        'name',
        'idtag',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'type',
        'idtag',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function resourcesIncidents()
    {
        return $this->belongsToMany(Incident::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
