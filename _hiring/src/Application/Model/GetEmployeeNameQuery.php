<?php declare(strict_types=1);

namespace Hiring\Application\Model;

class GetEmployeeNameQuery
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

    public static function fromArray(array $data): self
    {
        return new self($data['employeeId']);
    }
}
