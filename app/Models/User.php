<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Room;
use App\traits\GenUid;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use League\CommonMark\Delimiter\Delimiter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, GenUid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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

    public function canJoinRoom($roomId)
    {
        $granted = false;
        # code...
        $room = Room::findOrFail($roomId);
        $user = explode( ":", $room->users);
        foreach ($user as $id) {
            # code...\if
            if ($this->id == $id) {
                # code...
                $granted = true;
            }
        }
        return $granted;
    }
}
