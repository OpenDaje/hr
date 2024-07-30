<?php declare(strict_types=1);

namespace Hiring\Application\Model;

use Ecotone\Messaging\Attribute\Asynchronous;
use Ecotone\Modelling\Attribute\Aggregate;
use Ecotone\Modelling\Attribute\AggregateIdentifier;
use Ecotone\Modelling\Attribute\CommandHandler;
use Ecotone\Modelling\Attribute\QueryHandler;
use Ecotone\Modelling\WithAggregateEvents;

#[Aggregate]
class Employee
{
    use WithAggregateEvents;

    public function __construct(
        #[AggregateIdentifier]private readonly int $employeeId,
        private readonly string $name
    ) {
        $this->recordThat(new EmployeeWasEngagedEvent($employeeId));
    }

    #[Asynchronous("employees")]
    #[CommandHandler("employee.add", 'employee_add_endpoint')]
    public static function register(AddEmployeeCommand $command): self
    {
        echo "execute command for" . $command->getName() . "\n";
        return new self($command->getEmployeeId(), $command->getName());
    }

    #[QueryHandler]
    public function getName(GetEmployeeNameQuery $query): string
    {
        return $this->name;
    }
}
