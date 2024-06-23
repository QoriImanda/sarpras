<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sarana extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $guarded = ['prasarana_id'];

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

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function pjSarpras($sarprasID)
    {
        $pjSarpras = PenanggungJawabSarpras::where('sarpras_id', $sarprasID)->first();

        return $pjSarpras;
    }

    public function prasarana()
    {
        return $this->belongsToMany(Prasarana::class)->withTimestamps();
    }

    public function prasaranas()
    {
        return $this->belongsToMany(Prasarana::class);
    }

    public function logPemeliharaanSarpras($sarprasID, $thnPeriode, $smtr)
    {
        return LogPemeliharaanSarpras::where('sarpras_id', $sarprasID)
        ->where('tahun_periode', $thnPeriode)->where('semester', $smtr)->first();
    }

    public function pjSarana($sarprasID)
    {
        $pjSarpras = Sarana::join('prasarana_sarana', 'saranas.id', '=', 'prasarana_sarana.sarana_id')
        ->join('prasaranas', 'prasarana_sarana.prasarana_id', '=', 'prasaranas.id')
        ->join('penanggung_jawab_sarpras', 'prasaranas.id', '=', 'penanggung_jawab_sarpras.sarpras_id')
        ->join('user_details', 'penanggung_jawab_sarpras.user_id', '=', 'user_details.user_id')
        ->where('saranas.id', $sarprasID)->select('user_details.nama_lengkap')->first();

        // dd($pjSarpras);
        return $pjSarpras;
    }

    public function kodeInventaris()
    {
        return $this->belongsTo(KodeInventaris::class);
    }
}
