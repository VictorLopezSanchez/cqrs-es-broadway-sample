<?php

namespace App\Infrastructure\Booking\Persistence\Doctrine\Type;

use App\Domain\Booking\Model\ValueObject\UnsubscribedAt;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

final class UnsubscribedAtType extends Type
{
    const UNSUBSCRIBED_AT = 'unsubscribed_at';

    protected function getUidClass(): string
    {
        return UnsubscribedAt::class;
    }

    public function getName(): string
    {
        return self::UNSUBSCRIBED_AT;
    }

    /**
     * Adds an SQL comment to typehint the actual Doctrine Type for reverse schema engineering.
     */
    final public function requiresSQLCommentHint(AbstractPlatform $platform) : bool
    {
        return true;
    }

    /**
     * Converts a value from its database representation to its PHP representation of this type.
     *
     * @param mixed $value The value to convert.
     */
    public function convertToPHPValue($value, AbstractPlatform $platform) : ?UnsubscribedAt
    {
        return $value !== null ? UnsubscribedAt::fromFormat($value, UnsubscribedAt::FORMAT) : null;
    }

    /**
     * Converts a value from its PHP representation to its database representation of this type.
     *
     * @param UnsubscribedAt|null $value The value to convert.
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform) : ?string
    {
        return $value?->format($platform->getDateFormatString());
    }

    /**
     * Gets the SQL declaration snippet for a field of this type.
     */
    final public function getSQLDeclaration(array $column, AbstractPlatform $platform) : string
    {
        return $platform->getDateTimeTypeDeclarationSQL($column);
    }
}
