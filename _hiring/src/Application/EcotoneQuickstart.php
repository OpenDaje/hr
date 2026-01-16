<?php declare(strict_types=1);

namespace Hiring\Application;

use Ecotone\Messaging\Conversion\MediaType;
use Ecotone\Modelling\CommandBus;
use Ecotone\Modelling\QueryBus;
use Hiring\Application\Model\AddEmployeeCommand;
use Hiring\Application\Model\GetEmployeeNameQuery;

class EcotoneQuickstart
{
    public function __construct(
        private readonly CommandBus $commandBus,
        private readonly QueryBus $queryBus
    ) {
    }

    public function run(): void
    {
        $marioId = 10;
        $this->commandBus->sendWithRouting(
            'employee.add',
            new AddEmployeeCommand($marioId, "Mario - $marioId"),
            MediaType::APPLICATION_X_PHP
        );

        // should be async
        //echo $this->queryBus->send(new GetEmployeeNameQuery($marioId));

        $luigiId = $marioId + 1;
        $this->commandBus->sendWithRouting(
            'employee.add',
            [
                "employeeId" => $luigiId,
                "name" => "Luigi - $luigiId",
            ],
            MediaType::APPLICATION_X_PHP_ARRAY
        );

        //should be async
        //echo $this->queryBus->send(new GetEmployeeNameQuery($luigiId));
    }
}
