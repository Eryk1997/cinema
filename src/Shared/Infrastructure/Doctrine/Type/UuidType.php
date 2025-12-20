<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Symfony\Component\Uid\Uuid;

class UuidType extends Type
{
    public const NAME = 'uuid_mariadb';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getMappedDatabaseTypes(AbstractPlatform $platform): array
    {
        return ['char'];
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'CHAR(36)';
    }

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): ?string
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof Uuid) {
            // przechowujemy jako RFC4122 string (36 znaków)
            return $value->toRfc4122();
        }

        if (is_string($value)) {
            return $value;
        }

        throw new \InvalidArgumentException('Invalid UUID value.');
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?Uuid
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof Uuid) {
            return $value;
        }

        if (is_string($value)) {
            // przyjmujemy RFC4122 string
            return Uuid::fromRfc4122($value);
        }

        throw new \InvalidArgumentException('Invalid UUID value.');
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
