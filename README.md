<p align="center"><img src="https://raw.githubusercontent.com/Kodamity/.github/refs/heads/main/art/logo.svg" alt="Kodamity Logo"></p>

# PHP sdk for Viber api

<p align="center">
<a href="https://github.com/kodamity/viber-bot-php/actions?query=workflow%3Atests+branch%3Amain"><img src="https://img.shields.io/github/actions/workflow/status/kodamity/viber-bot-php/tests.yml?branch=main&label=tests&style=flat-square" alt="Build Status"></a>
<a href="https://packagist.org/packages/kodamity/viber-bot-php"><img src="https://img.shields.io/packagist/dt/kodamity/viber-bot-php.svg?style=flat-square" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/kodamity/viber-bot-php"><img src="https://img.shields.io/packagist/v/kodamity/viber-bot-php.svg?style=flat-square" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/kodamity/viber-bot-php"><img src="https://img.shields.io/packagist/l/kodamity/viber-bot-php" alt="License"></a>
</p>

Library to develop a bot for the Viber platform. [Create you first Viber bot step by step](docs/first-steps.md), see demo at `viber://pa?chatURI=viber-bot-php&context=github.com`

## Installation

```
composer require kodamity/viber-bot-php
```

## Example

```php
<?php

require_once("../vendor/autoload.php");

use Viber\Bot;
use Viber\Api\Sender;

$apiKey = '<PLACE-YOU-API-KEY-HERE>';

// reply name
$botSender = new Sender([
    'name' => 'Whois bot',
    'avatar' => 'https://developers.viber.com/img/favicon.ico',
]);

try {
    $bot = new Bot(['token' => $apiKey]);
    $bot
    ->onConversation(function ($event) use ($bot, $botSender) {
        // this event fires if user open chat, you can return "welcome message"
        // to user, but you can't send more messages!
        return (new \Viber\Api\Message\Text())
            ->setSender($botSender)
            ->setText("Can i help you?");
    })
    ->onText('|whois .*|si', function ($event) use ($bot, $botSender) {
        // match by template, for example "whois Bogdaan"
        $bot->getClient()->sendMessage(
            (new \Viber\Api\Message\Text())
            ->setSender($botSender)
            ->setReceiver($event->getSender()->getId())
            ->setText("I do not know )")
        );
    })
    ->run();
} catch (Exception $e) {
    // todo - log exceptions
}
```

See more in **examples** directory.

## Library structure

```
.
├── Api
│   ├── Entity.php               
│   ├── Event                     # all remote events ("callbacks")
│   │   ├── Conversation.php      # fires when user open 1v1 chat
│   │   ├── Delivered.php         # fires when message delivered (for each device)
│   │   ├── Factory.php           # Event factory
│   │   ├── Failed.php            # fires when delivery failed (for each device)
│   │   ├── Message.php           # fires when user send message
│   │   ├── Seen.php              # fires when user read message (for each device)
│   │   ├── Subscribed.php        # fires when user subscribe to PA
│   │   ├── Type.php              # available types
│   │   └── Unsubscribed.php      # fires when user unsubscribed
│   ├── Event.php                 # base class for all events
│   ├── Exception                 #
│   │   └── ApiException.php      # remote or logic error
│   ├── Keyboard                  #
│   │   └── Button.php            # all types of buttons here
│   ├── Keyboard.php              # button container
│   ├── Message                   #
│   │   ├── CarouselContent.php   #
│   │   ├── Contact.php           #
│   │   ├── Factory.php           #
│   │   ├── File.php              #
│   │   ├── Location.php          #
│   │   ├── Picture.php           #
│   │   ├── Sticker.php           #
│   │   ├── Text.php              #
│   │   ├── Type.php              # available message types
│   │   ├── Url.php               #
│   │   └── Video.php             #
│   ├── Message.php               # base class for all messages
│   ├── Response.php              # wrap api response
│   ├── Sender.php                # represent bot-sender
│   ├── Signature.php             # signature helper (verify or create sign)
│   ├── User                      #
│   │   └── State.php             # user state (online/offline etc)
│   └── User.php                  # viber user
├── Bot                           #
│   └── Manager.php               # manage bot closures
├── Bot.php                       # bot class
└── Client.php                    # api client
```


## Read more

- [Create you first Viber bot](docs/first-steps.md)
- [Cookbook](docs/cookbook.md)
- [REST api documentation](https://developers.viber.com/api/rest-bot-api/index.html)
- [SDK for node](https://github.com/Viber/viber-bot-node)
- [SDK for python](https://github.com/Viber/viber-bot-python)
- [Project page](http://viber.hcbogdan.com/)

## Features

- [x] all api entities
- [x] validate request and response signs
- [x] provide webhook interface
- [x] provide event interface
- [ ] wrap all api response to entities
- [ ] validate api entities before submit?
- [ ] implement log levels with monolog?
- [ ] post on public page


## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [:author_name](https://github.com/:author_username)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

