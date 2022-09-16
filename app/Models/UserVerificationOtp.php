<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserVerificationOtp
 *
 * @property int $id
 * @property string $uuid
 * @property string $phone
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerificationOtp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerificationOtp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerificationOtp query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerificationOtp whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerificationOtp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerificationOtp wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerificationOtp whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerificationOtp whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerificationOtp whereUuid($value)
 * @mixin \Eloquent
 */
class UserVerificationOtp extends Model
{
    use HasFactory;
}
