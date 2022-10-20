<?php

namespace App\Http\Requests\API\Chat;

use App\Models\Media;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChatMessageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "type" => "required|in:text,images,audios,location",
            "message_text" => [
                Rule::requiredIf($this->input("type") == "text"),
                "string",
                "max:255"
            ],
            "images" => [
                Rule::requiredIf($this->input("type") == "images"),
                "array",
            ],
            "images.*" => [
                Rule::requiredIf($this->input("type") == "images"),
                "mimetypes:" . implode(",", Media::$IMAGES_MIMES_TYPES),
            ],
            "audios" => [
                Rule::requiredIf($this->input("type") == "audios"),
                "array",
            ],
            "audios.*" => [
                Rule::requiredIf($this->input("type") == "audios"),
                "mimetypes:audio/x-mp3,audio/mp4,audio/x-mp2,application/ogg,audio/mpeg,audio/mp4,audio/mpeg",
            ],
            "location.lat" => [
                Rule::requiredIf($this->input("type") == "location"),
                "numeric",
            ],
            "location.long" => [
                Rule::requiredIf($this->input("type") == "location"),
                "numeric",
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
