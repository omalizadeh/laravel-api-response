<?php

namespace Omalizadeh\ApiResponse\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Omalizadeh\ApiResponse\Resources\BaseApiResource;

class BaseApiRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, response(BaseApiResource::make([
            'message' => $validator->errors()->first(),
            'errors' => $validator->errors()->toArray(),
        ]), Response::HTTP_UNPROCESSABLE_ENTITY), $this->errorBag);
    }
}
