<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fakultas extends Model
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

    // public function dekanFakultas($id)
    // {
    //     $userDetail = UserDetail::join('role_user', 'role_user.user_id', '=', 'user_details.user_id')
    //         ->join('roles', 'roles.id', '=', 'role_user.role_id')
    //         ->join('prodis', 'prodis.id', '=', 'user_details.prodi_id')
    //         ->join('fakultas', 'fakultas.id', '=', 'prodis.fakultas_id')
    //         ->where('role_code', 'DFS')->where('fakultas_id', $id)
    //         ->first();
    //     // dd($userDetail);
    //     return $userDetail;
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
