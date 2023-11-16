<?php

namespace Modules\Hub\App\Repositories\Datas\Enums;

enum OfferStatusEnum: string
{
    case active = 'active';

    case inactive = 'paused';
}
