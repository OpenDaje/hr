<?php declare(strict_types=1);

namespace Hiring\Adapter\Messaging;

use Ecotone\Amqp\AmqpBackedMessageChannelBuilder;
use Ecotone\Messaging\Attribute\ServiceContext;

class MessagingConfiguration
{
    #[ServiceContext]
    public function employeeChannel()
    {
        return [
            AmqpBackedMessageChannelBuilder::create("employees"),
        ];
    }
}
