<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Prev extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public const STATUS_SELECT = [
        'active'    => 'Actief',
        'cancelled' => 'Geannuleerd',
        'done'      => 'Afgerond',
    ];

    public const PREVTYPE_SELECT = [
        'local'        => 'Lokale PHA',
        'localsupport' => 'Lokaal in steun',
        'provincial'   => 'Provinciaal',
        'other'        => 'Anders',
    ];

    public $table = 'prevs';

    public static $searchable = [
        'name',
    ];

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'prevtype',
        'description',
        'internalinfo',
        'date',
        'starttime',
        'endtime',
        'rvtime',
        'location_id',
        'created_by_id',
        'papyrus',
        'prima',
        'prevresponsible_id',
        'amount',
        'cares',
        'ambulancetransports',
        'report',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function prevPrevregistrations()
    {
        return $this->hasMany(Prevregistration::class, 'prev_id', 'id');
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function prevresponsible()
    {
        return $this->belongsTo(User::class, 'prevresponsible_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
