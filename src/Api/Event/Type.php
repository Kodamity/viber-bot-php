<?php

namespace Viber\Api\Event;

/**
 * Available event types
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
interface Type
{
    public const DELIVERED = 'delivered';
    public const SEEN = 'seen';
    public const FAILED = 'failed';
    public const SUBSCRIBED = 'subscribed';
    public const UNSUBSCRIBED = 'unsubscribed';
    public const CONVERSATION = 'conversation_started';
    public const MESSAGE = 'message';
    public const WEBHOOK = 'webhook';
}
