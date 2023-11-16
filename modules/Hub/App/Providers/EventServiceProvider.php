<?php

namespace Modules\Hub\App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Hub\App\Events\WebhookReceivedEvent;
use Modules\Hub\App\Listeners\Webhook\WebhookReceived\GetProduct;
use Modules\Hub\App\Listeners\Webhook\WebhookReceived\GetProductInPlatform;
use Modules\Hub\App\Listeners\Webhook\WebhookReceived\GetRelation;
use Modules\Hub\App\Listeners\Webhook\WebhookReceived\SendWebhook;
use Modules\Hub\App\Listeners\Webhook\WebhookReceived\UpdateOffer;
use Modules\Hub\App\Listeners\Webhook\WebhookReceived\UpdateProduct;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        WebhookReceivedEvent::class => [
            GetProductInPlatform::class,
            GetProduct::class,
            UpdateProduct::class,
            GetRelation::class,
            UpdateOffer::class,
            SendWebhook::class
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
