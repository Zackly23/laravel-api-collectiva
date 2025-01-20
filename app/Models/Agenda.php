<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    //
    protected $guarded = ['agenda_uuid'];

    protected $primaryKey = 'agenda_uuid';

    protected $keyType = 'string';

    public $incrementing = false;
    use HasUuids;

    public static function booted() {
        static::creating(function ($model) {
            $model->agenda_uuid = Str::uuid();
        });
    }
}
