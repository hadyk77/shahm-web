<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\CaptainVerificationFile
 *
 * @property int $id
 * @property int $captain_id
 * @property int $verification_option_id
 * @property int $user_id
 * @property string $status
 * @property int $is_read
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Captain $captain
 * @property-read \App\Models\VerificationOption $option
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|CaptainVerificationFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CaptainVerificationFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CaptainVerificationFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|CaptainVerificationFile whereCaptainId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaptainVerificationFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaptainVerificationFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaptainVerificationFile whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaptainVerificationFile whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaptainVerificationFile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaptainVerificationFile whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CaptainVerificationFile whereVerificationOptionId($value)
 * @mixin \Eloquent
 */
class CaptainVerificationFile extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function captain(): BelongsTo
    {
        return $this->belongsTo(Captain::class);
    }

    public function option(): BelongsTo
    {
        return $this->belongsTo(VerificationOption::class, "verification_option_id");
    }

}
