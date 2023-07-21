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

    #[AggregateIdentifier]
    private int $employeeId;

    private string $name;

    public function __construct(int $employeeId, string $name)
    {
        $this->employeeId = $employeeId;
        $this->name = $name;

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
