<?php declare(strict_types=1);

namespace Hiring\Application\Model;

class GetEmployeeNameQuery
{
    public function __construct(
        private int $employeeId
    ) {
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
