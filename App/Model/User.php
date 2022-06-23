<?php

namespace RemoteConfig\App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_email",
        "password",
        "phone",
        "user_type",
        "is_phone_verified",
        "is_email_verified",
        "is_super_admin",
        'is_admin',
        'name',
        'is_available'
    ];

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
    public function slugs(): HasMany
    {
        return $this->hasMany(Slug::class);
    }

    /**
     * @return HasMany
     */
    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }


    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }


    /**
     * @return HasMany
     */
    public function clicks(): HasMany
    {
        return $this->hasMany(Click::class);
    }


    public static function getUserByEmailAndPassword(string $email, string $password)
    {
        $user = self::where("user_email", $email)->first();
        if (!$user || !password_verify($password, $user->password)) {
            return false;
        }
        return $user;
    }


    /**
     * @return BelongsToMany
     */
    public function userSessionActivities(): BelongsToMany
    {
        return $this->belongsToMany(UserSessionActivity::class);
    }

    /**
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return boolval($this->is_super_admin);
    }

    /**
     * @param string $permissionName
     * @return bool
     */
    public function hasPermission(string $permissionName): bool
    {
        $roles = $this->roles()->get();
        foreach ($roles as $role) {
            $permissions = $role->permissions()->get();
            foreach ($permissions as $permission) {
                if ($permission->permission_name == $permissionName) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return boolval($this->is_admin);
    }

    /**
     * @return bool
     */
    public function isPhoneVerify(): bool
    {
        return boolval($this->is_phone_verified);
    }


    /**
     * @return bool
     */
    public function canCreateSlug(): bool
    {
        if ($this->user_type == 2) {
            return true;
        } elseif ($this->user_type == 1) {
            return $this->slugs()->count() < 30;
        } else {
            return $this->slugs()->count() < 5;
        }
    }
}