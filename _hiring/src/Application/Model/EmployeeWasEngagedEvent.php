<?php declare(strict_types=1);

namespace Hiring\Application\Model;

class EmployeeWasEngagedEvent
{
    private int $employeeId;

    public function __construct(int $employeeId)
    {
        $this->employeeId = $employeeId;
    }

    public function getEmployeeId(): int
    {
        return $this->employeeId;
    }
}
