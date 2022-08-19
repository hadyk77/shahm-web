<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

/**
 * App\Models\Media
 *
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property string|null $uuid
 * @property string $collection_name
 * @property string $name
 * @property string $file_name
 * @property string|null $mime_type
 * @property string $disk
 * @property string|null $conversions_disk
 * @property int $size
 * @property array $manipulations
 * @property array $custom_properties
 * @property array $generated_conversions
 * @property array $responsive_images
 * @property int|null $order_column
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Model|Eloquent $model
 * @method static MediaCollection|static[] all($columns = ['*'])
 * @method static MediaCollection|static[] get($columns = ['*'])
 * @method static Builder|Media newModelQuery()
 * @method static Builder|Media newQuery()
 * @method static Builder|Media ordered()
 * @method static Builder|Media query()
 * @method static Builder|Media whereCollectionName($value)
 * @method static Builder|Media whereConversionsDisk($value)
 * @method static Builder|Media whereCreatedAt($value)
 * @method static Builder|Media whereCustomProperties($value)
 * @method static Builder|Media whereDisk($value)
 * @method static Builder|Media whereFileName($value)
 * @method static Builder|Media whereGeneratedConversions($value)
 * @method static Builder|Media whereId($value)
 * @method static Builder|Media whereManipulations($value)
 * @method static Builder|Media whereMimeType($value)
 * @method static Builder|Media whereModelId($value)
 * @method static Builder|Media whereModelType($value)
 * @method static Builder|Media whereName($value)
 * @method static Builder|Media whereOrderColumn($value)
 * @method static Builder|Media whereResponsiveImages($value)
 * @method static Builder|Media whereSize($value)
 * @method static Builder|Media whereUpdatedAt($value)
 * @method static Builder|Media whereUuid($value)
 * @mixin Eloquent
 */
class Media extends BaseMedia
{

    public static array $IMAGES_MIMES_TYPES = [
        'image/apng',
        'image/avif',
        'image/gif',
        'image/jpeg',
        'image/png',
        'image/svg+xml',
        'image/svg',
        'image/webp',
    ];

    public static array $VIDEO_MIME_TYPES = [
        'application/annodex',
        'application/mp4',
        'application/ogg',
        'application/vnd.rn-realmedia',
        'application/x-matroska',
        'video/3gpp',
        'video/3gpp2',
        'video/annodex',
        'video/divx',
        'video/flv',
        'video/h264',
        'video/mp4',
        'video/mp4v-es',
        'video/mpeg',
        'video/mpeg-2',
        'video/mpeg4',
        'video/ogg',
        'video/ogm',
        'video/quicktime',
        'video/ty',
        'video/vdo',
        'video/vivo',
        'video/vnd.rn-realvideo',
        'video/vnd.vivo',
        'video/webm',
        'video/x-bin',
        'video/x-cdg',
        'video/x-divx',
        'video/x-dv',
        'video/x-flv',
        'video/x-la-asf',
        'video/x-m4v',
        'video/x-matroska',
        'video/x-motion-jpeg',
        'video/x-ms-asf',
        'video/x-ms-dvr',
        'video/x-ms-wm',
        'video/x-ms-wmv',
        'video/x-msvideo',
        'video/x-sgi-movie',
        'video/x-tivo',
        'video/avi',
        'video/x-ms-asx',
        'video/x-ms-wvx',
        'video/x-ms-wmx',
    ];

}
