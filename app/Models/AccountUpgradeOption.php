<?php

namespace App\Models;

use App\Traits\HasTranslationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountUpgradeOption
 *
 * @property int $id
 * @property array $title
 * @property int $completed_orders_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountUpgradeOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountUpgradeOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountUpgradeOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountUpgradeOption whereCompletedOrdersCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountUpgradeOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountUpgradeOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountUpgradeOption whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountUpgradeOption whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountUpgradeOption extends BaseModel
{
    use HasFactory, HasTranslationTrait;

}
