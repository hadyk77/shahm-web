<?php

namespace App\Models;

use App\Traits\HasTranslationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends BaseModel
{
    use HasFactory, HasTranslationTrait;
}
