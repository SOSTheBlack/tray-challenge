<?php

namespace Modules\Hub\App\Http\Requests\Webhooks;

enum WebhookScopeEnum: string
{
    case price = 'price';

    case stock = 'stock';

    case status = 'status';
}
