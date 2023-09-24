<?php

namespace Electro\App\Model;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = !is_null($value) ? password_hash($value, PASSWORD_BCRYPT) : $this->password;
    }

    /**
     * @return HasMany
     */
    public function phoneCodes(): HasMany
    {
        return $this->hasMany(PhoneCode::class);
    }

    /**
     * @return HasMany
     */
    public function emailLinks(): HasMany
    {
        return $this->hasMany(EmailLink::class);
    }

    /**
     * @return HasMany
     */
    public function profiles(): HasMany
    {
        return $this->hasMany(UserProfile::class);
    }

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public static function findUserByPhoneAndPassword($phone, $password)
    {
        $user = User::where("phone", $phone)->first();
        if (!$user) {
            return false;
        }
        return password_verify($password, $user->password) ? $user : false;
    }

}