<?php

namespace App\Models;

use App\Enums\CaptainEnum;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\CaptainVerificationFile
 *
 * @property int $id
 * @property int $captain_id
 * @property int $verification_option_id
 * @property int $user_id
 * @property string $status
 * @property int $is_read
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Captain $captain
 * @property-read VerificationOption $option
 * @property-read User $user
 * @method static Builder|CaptainVerificationFile newModelQuery()
 * @method static Builder|CaptainVerificationFile newQuery()
 * @method static Builder|CaptainVerificationFile query()
 * @method static Builder|CaptainVerificationFile whereCaptainId($value)
 * @method static Builder|CaptainVerificationFile whereCreatedAt($value)
 * @method static Builder|CaptainVerificationFile whereId($value)
 * @method static Builder|CaptainVerificationFile whereIsRead($value)
 * @method static Builder|CaptainVerificationFile whereStatus($value)
 * @method static Builder|CaptainVerificationFile whereUpdatedAt($value)
 * @method static Builder|CaptainVerificationFile whereUserId($value)
 * @method static Builder|CaptainVerificationFile whereVerificationOptionId($value)
 * @mixin Eloquent
 */
class CaptainVerificationFile extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(CaptainEnum::VERIFICATION_FILE)->singleFile();
    }

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

    public function markAsRead(): void
    {
        $this->update([
            "is_read" => 1,
        ]);
    }

    public function markAsAccepted(): void
    {
        $this->update([
            "status" => 1,
        ]);
    }

    public function markAsRejected(): void
    {
        $this->update([
            "status" => 0,
        ]);
    }

}
