<?php

namespace Modules\Hub\App\Http\Requests\Webhooks;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class WebhookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    #[ArrayShape(['product_ref' => "string[]", 'scope' => "string[]"])]
    public function rules(): array
    {
        return [
            'product_ref' => ['required', 'int'],
            'scope' => ['required', 'in:price,stock,status']
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): true
    {
        return true;
    }
}
