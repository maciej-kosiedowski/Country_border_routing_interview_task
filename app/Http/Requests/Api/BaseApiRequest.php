<?php

declare(strict_types=1);

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class BaseApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.

     *
     * @return bool
     */
    public function authorize()
    {
        // Auth::user()->can..  # I don`t implement authorization, out of scope for this task
        return $this->isJson() && $this->expectsJson();
    }
}
