<?php

namespace Modules\Hub\App\Http\Requests\Webhooks;

use Spatie\LaravelData\Data;

class WebhookData extends Data
{
    /**
     * @var int
     */
    public int $product_ref;

    /**
     * @var WebhookScopeEnum
     */
    public WebhookScopeEnum $scope;
}
