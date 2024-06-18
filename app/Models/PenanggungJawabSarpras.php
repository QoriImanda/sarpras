<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenanggungJawabSarpras extends Model
{
    use HasFactory;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prasarana($sarprasID)
    {
        // dd($sarprasID);
        return Prasarana::where('id', $sarprasID)->first();
    }

    public function sarpras($sarprasID, $sarprasOrPrasarana)
    {
        // dd($sarprasID, $sarprasOrPrasarana);
        if ($sarprasOrPrasarana == 'Prasarana') {
            return Prasarana::find($sarprasID);
        } elseif($sarprasOrPrasarana == 'Sarana') {
            return Sarana::find($sarprasID);
        }
    }

    public function logPemeliharaanSarpras($sarprasID, $thnPeriode, $smtr)
    {
        // dd($sarprasID);
        return LogPemeliharaanSarpras::where('sarpras_id', $sarprasID)
        ->where('tahun_periode', $thnPeriode)->where('semester', $smtr)->first();
    }
}
