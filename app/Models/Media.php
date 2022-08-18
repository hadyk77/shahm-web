<?php

namespace App\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

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
