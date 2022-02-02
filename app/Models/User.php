<?php

namespace App\Models;

use Lab404\Impersonate\Models\Impersonate;
use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Notifications\ResetPasswordNotification;


class User extends Authenticatable implements HasMedia
{
    use SoftDeletes;
    use Notifiable;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;
    use Impersonate;

    public $table = 'users';

    public static $searchable = [
        'firstname',
        'name',
        'email',
        'rkid',
        'dghid',
        'phone',
        'pagerid',
    ];

    protected $appends = [
        'photo',
    ];

    protected $hidden = [
        'remember_token', 'two_factor_code',
        'password',
    ];

    protected $dates = [
        'email_verified_at',
        'birthdate',
        'created_at',
        'updated_at',
        'deleted_at',
        'two_factor_expires_at',
    ];

    protected $fillable = [
        'firstname',
        'name',
        'email',
        'two_factor',
        'emailprivate',
        'two_factor_code',
        'email_verified_at',
        'password',
        'birthdate',
        'city',
        'remember_token',
        'rkid',
        'dghid',
        'phone',
        'pagerid',
        'created_at',
        'created_by_id',
        'updated_at',
        'deleted_at',
        'two_factor_expires_at',
        'active',
    ];

    public function generateTwoFactorCode()
    {
        $this->timestamps            = false;
        $this->two_factor_code       = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(15)->format(config('panel.date_format') . ' ' . config('panel.time_format'));
        $this->save();
    }

    public function resetTwoFactorCode()
    {
        $this->timestamps            = false;
        $this->two_factor_code       = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public static function boot()
    {
        parent::boot();
        User::observe(new \App\Observers\UserActionObserver());
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function useridNotes()
    {
        return $this->hasMany(Note::class, 'userid_id', 'id');
    }

    public function userCompetenceregistrations()
    {
        return $this->hasMany(Competenceregistration::class, 'user_id', 'id');
    }

    public function userPrevregistrations()
    {
        return $this->hasMany(Prevregistration::class, 'user_id', 'id');
    }

    public function assigneduserTasks()
    {
        return $this->hasMany(Task::class, 'assigneduser_id', 'id');
    }

    public function userEventregistrations()
    {
        return $this->hasMany(Eventregistration::class, 'user_id', 'id');
    }

    public function userComlogs()
    {
        return $this->hasMany(Comlog::class, 'user_id', 'id');
    }

    public function usersIncidents()
    {
        return $this->belongsToMany(Incident::class);
    }

    public function userUserAlerts()
    {
        return $this->belongsToMany(UserAlert::class);
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        //$this->notify(new ResetPassword($token));
        $this->notify(new ResetPasswordNotification($token));
    }


    public function getBirthdateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBirthdateAttribute($value)
    {
        $this->attributes['birthdate'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function competenceregistrations()
    {
        return $this->belongsToMany(Competenceregistration::class);
    }

    public function getTwoFactorExpiresAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setTwoFactorExpiresAtAttribute($value)
    {
        $this->attributes['two_factor_expires_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * @return bool
     */
    public function canImpersonate()
    {
        // For example
        return $this->is_admin == 1;
        //return 1;
    }

    /**
     * @return bool
     */



}
