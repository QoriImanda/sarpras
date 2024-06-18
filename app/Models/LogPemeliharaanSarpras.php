<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogPemeliharaanSarpras extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $primaryKey = 'id'; // Nama kolom UUID
    public $incrementing = false; // Set primary key menjadi non-incrementing
    protected $keyType = 'string'; // Tipe data primary key adalah string

    protected static function boot()
    {
        parent::boot();

        // Membuat UUID baru sebelum menyimpan model
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
        });
    }
}
