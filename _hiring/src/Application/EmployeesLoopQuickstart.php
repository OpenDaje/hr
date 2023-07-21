<?php declare(strict_types=1);

namespace Hiring\Application;

use Ecotone\Messaging\Conversion\MediaType;
use Ecotone\Modelling\CommandBus;
use Ecotone\Modelling\QueryBus;
use Hiring\Application\Model\AddEmployeeCommand;

class EmployeesLoopQuickstart
{
    private CommandBus $commandBus;

    private QueryBus $queryBus;

    public function __construct(CommandBus $commandBus, QueryBus $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    public function run(): void
    {
        for ($i = 10000; ; $i++) {
            $this->commandBus->sendWithRouting(
                'employee.add',
                new AddEmployeeCommand($i, "Mario - $i"),
                MediaType::APPLICATION_X_PHP
            );

            if ($i > 15000) {
                break;
            }
        }
    }
}
