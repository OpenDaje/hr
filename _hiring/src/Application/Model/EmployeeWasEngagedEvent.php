<?php declare(strict_types=1);

namespace Hiring\Application\Model;

class EmployeeWasEngagedEvent
{
    public function __construct(
        private readonly int $employeeId
    ) {
    }

    public function getEmployeeId(): int
    {
        return $this->employeeId;
    }
}
