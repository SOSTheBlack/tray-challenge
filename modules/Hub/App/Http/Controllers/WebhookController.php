<?php

namespace Modules\Hub\App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Log;
use Modules\Hub\App\Events\WebhookReceivedEvent;
use Modules\Hub\App\Http\Requests\Webhooks\WebhookData;
use Modules\Hub\App\Http\Requests\Webhooks\WebhookRequest;
use Throwable;

final class WebhookController extends HubController
{
    /**
     * @param WebhookRequest $request
     *
     * @return JsonResponse
     */
    public function __invoke(WebhookRequest $request): JsonResponse
    {
        try {
            event(new WebhookReceivedEvent(WebhookData::from($request)));

            $response = response()->json(['msg' => 'success']);
        } catch (Throwable $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());

            $response = response()->json(['msg' => 'error', 'msg_error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        } finally {
            return $response;
        }
    }
}
