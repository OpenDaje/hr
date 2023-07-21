<?php declare(strict_types=1);

namespace Hiring\Application\Model;

class AddEmployeeCommand
{
    private int $employeeId;

    private string $name;

    public function __construct(int $employeeId, string $name)
    {
        $this->employeeId = $employeeId;
        $this->name = $name;
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
