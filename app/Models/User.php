<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Ramsey\Uuid\Uuid;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'secret'
    ];

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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query
                ->where('nim', 'like', '%' . $search . '%')
                ->orWhere('user_details.nama_lengkap', 'like', '%' . $search . '%');
        });
    }

    public function userDetail()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function prodis($id = null){
        // dd($id);
        return Prodi::find($id);
    }
}
