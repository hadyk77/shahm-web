<?php

namespace App\Http\Controllers\API\V1\Captain;

use App\Enums\CaptainEnum;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\VerificationOptions\VerificationOptionsResource;
use App\Models\CaptainVerificationFile;
use App\Models\VerificationOption;
use Auth;
use Illuminate\Http\Request;

class VerificationFileController extends Controller
{

    public function index()
    {
        $captainVerificationFiles = VerificationOption::query()->enabled()->get();
        return $this::sendSuccessResponse(VerificationOptionsResource::collection($captainVerificationFiles));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "option_verification_id" => "required|exists:verification_options,id",
            "file" => Helper::imageRules()
        ]);

        $optionVerification = VerificationOption::query()
            ->whereNotIn("id", [1, 2])
            ->enabled()
            ->findOrFail($request->option_verification_id);


        $captainFileExists = CaptainVerificationFile::query()
            ->where("user_id", Auth::id())
            ->where("captain_id", Auth::user()->captain->id)
            ->where("verification_option_id", $optionVerification->id)
            ->exists();

        if (!$captainFileExists) {

            $captainVerificationFile = CaptainVerificationFile::query()->create([
                "user_id" => Auth::id(),
                "captain_id" => Auth::user()->captain->id,
                "verification_option_id" => $optionVerification->id,
            ]);

            if ($request->hasFile("file")) {
                $captainVerificationFile->addMedia($request->file)->toMediaCollection(CaptainEnum::VERIFICATION_FILE);
            }

            return $this::sendSuccessResponse([], __("Request Send Successfully"));
        }

        $captainFile = CaptainVerificationFile::query()
            ->where("user_id", Auth::id())
            ->where("captain_id", Auth::user()->captain->id)
            ->where("verification_option_id", $optionVerification->id)
            ->firstOrFail();

        $captainFile->update([
            "status" => 0
        ]);

        $captainFile->addMedia($request->file)->toMediaCollection(CaptainEnum::VERIFICATION_FILE);

        return $this::sendSuccessResponse([], __("Request Send Successfully"));

    }
}
