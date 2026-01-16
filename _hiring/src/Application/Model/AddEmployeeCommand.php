<?php declare(strict_types=1);

namespace Hiring\Application\Model;

class AddEmployeeCommand
{
    public function __construct(
        private readonly int $employeeId,
        private readonly string $name
    ) {
    }

    public function getEmployeeId(): int
    {
        return $this->employeeId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function fromArray(array $data): self
    {
        return new self($data['employeeId'], $data['name']);
    }
}
