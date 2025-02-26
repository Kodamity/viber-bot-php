<?php

namespace Viber\Api\Message;

/**
 * Available message types
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
interface Type
{
    public const TEXT = 'text';
    public const PICTURE = 'picture';
    public const VIDEO = 'video';
    public const FILE = 'file';
    public const STICKER = 'sticker';
    public const CONTACT = 'contact';
    public const URL = 'url';
    public const LOCATION = 'location';
    public const RICH_MEDIA = 'rich_media';
}
