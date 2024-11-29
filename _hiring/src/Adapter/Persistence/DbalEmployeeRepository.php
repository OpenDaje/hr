<?php declare(strict_types=1);

namespace Hiring\Adapter\Persistence;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Ecotone\Messaging\Conversion\MediaType;
use Ecotone\Messaging\Gateway\Converter\Serializer;
use Ecotone\Modelling\Attribute\Repository;
use Ecotone\Modelling\StandardRepository;
use Hiring\Application\Model\Employee;

#[Repository]
class DbalEmployeeRepository implements StandardRepository
{
    final public const TABLE_NAME = "aggregate";

    final public const CONNECTION_DSN = 'sqlite:///var/db-prova.sqlite';

    private readonly Connection $connection; // 2

    public function __construct(
        private readonly Serializer $serializer
    ) {
        $this->connection = DriverManager::getConnection([
            'url' => self::CONNECTION_DSN,
        ]);
    }

    public function canHandle(string $aggregateClassName): bool
    {
        return true;
        //return $aggregateClassName === Employee::class;
    }

    public function findBy(string $aggregateClassName, array $identifiers): ?object
    {
        $this->createSharedTableIfNeeded(); // 3

        $record = $this->connection->executeQuery(<<<SQL
    SELECT * FROM aggregate WHERE id = :id AND class = :class
SQL, [
            "id" => $this->getFirstId($identifiers),
            "class" => $aggregateClassName,
        ])->fetch(\PDO::FETCH_ASSOC);

        if (! $record) {
            return null;
        }

        // 4
        return $this->serializer->convertToPHP($record["data"], MediaType::APPLICATION_JSON, $aggregateClassName);
    }

    public function save(array $identifiers, object $aggregate, array $metadata, ?int $expectedVersion): void
    {
        $this->createSharedTableIfNeeded();

        $aggregateClass = $aggregate::class;
        // 5
        $data = $this->serializer->convertFromPHP($aggregate, MediaType::APPLICATION_JSON);

        if ($this->findBy($aggregateClass, $identifiers)) {
            $this->connection->update(
                self::TABLE_NAME,
                [
                    "data" => $data,
                ],
                [
                    "id" => $this->getFirstId($identifiers),
                    "class" => $aggregateClass,
                ]
            );

            return;
        }

        $this->connection->insert(self::TABLE_NAME, [
            "id" => $this->getFirstId($identifiers),
            "class" => $aggregateClass,
            "data" => $data,
        ]);
    }

    private function createSharedTableIfNeeded(): void
    {
        $hasTable = $this->connection->executeQuery(<<<SQL
SELECT name FROM sqlite_master WHERE name=:tableName
SQL, [
            "tableName" => self::TABLE_NAME,
        ])->fetchOne();

        if (! $hasTable) {
            $this->connection->executeStatement(
                <<<SQL
CREATE TABLE aggregate (
    id VARCHAR(255),
    class VARCHAR(255),
    data TEXT,
    PRIMARY KEY (id, class)
)
SQL
            );
        }
    }

    /**
     * @return mixed
     */
    private function getFirstId(array $identifiers)
    {
        return array_values($identifiers)[0];
    }
}