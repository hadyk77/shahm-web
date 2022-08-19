<?php

namespace App\Http\Controllers\Admin\Status;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            "model" => 'required|string',
            "model_id" => "required|numeric",
            "column_name" => "required|string",
        ]);

        $model = app($request->model)->find($request->model_id);

        if (is_null($model)) {
            return $this::sendFailedResponse(__('Model Not Found'));
        }

        $model->update([
            $request->column_name => $model->{$request->column_name} == 1 ? 0 : 1,
        ]);

        return $this::sendSuccessResponse([], __('Updated Done Successfully'));
    }
}
