<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prasarana extends Model
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

    // public function kategoris($kategori_id)
    // {
    //     return Kategori::find($kategori_id);
    // }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function pjSarpras($sarprasID)
    {
        $pjSarpras = PenanggungJawabSarpras::where('sarpras_id', $sarprasID)->first();

        return $pjSarpras;
    }

    public function sarana()
    {
        return $this->belongsToMany(Sarana::class)->withTimestamps();
    }

    public function saranas()
    {
        return $this->belongsToMany(Sarana::class);
    }

    public function logPemeliharaanSarpras($sarprasID, $thnPeriode, $smtr)
    {
        return LogPemeliharaanSarpras::where('sarpras_id', $sarprasID)
        ->where('tahun_periode', $thnPeriode)->where('semester', $smtr)->first();
    }

    public function kodeInventaris()
    {
        return $this->belongsTo(KodeInventaris::class);
    }

}
