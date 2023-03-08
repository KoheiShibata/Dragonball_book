<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminUser extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = "admin_users";
    protected $guarded = ['id'];

    /**
     * 対象のメールアドレスが存在するか
     *
     * @param object $query
     * @param string $email
     * @return boolean
     */
    public function scopeIsMailExists(object $query, string $email): bool
    {
        return $query
            ->where([
                "deleted_at" => null,
                "email" => $email,
            ])
            ->exists();
    }

    /**
     * メールアドレスを参照にデータを取得
     *
     * @param object $query
     * @param string $email
     * @return object
     */
    public function scopeFetchAdminUserByMail(object $query, string $email): object
    {
        return $query
            ->where([
                "deleted_at" => null,
                "email" => $email,
            ])
            ->first();
    }
}
