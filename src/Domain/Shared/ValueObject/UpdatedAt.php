<?php

declare(strict_types=1);

namespace App\Domain\Shared\ValueObject;

use Assert\Assertion;
use DateTime;

class UpdatedAt implements \JsonSerializable
{
    private ?DateTime $updatedAt = null;

    public const FORMAT = 'Y-m-d H:i:s';
    protected function __construct(?string $updateAt) {
        $this->updatedAt = $updateAt;
    }

    public function toString(): ?string
    {
        return ($this->updatedAt) ? $this->updatedAt->format(self::FORMAT) : null;
    }

    public function format(string $format): string
    {
        return $this->updatedAt->format($format);
    }

    public static function fromString(string $date): self
    {
        return self::fromFormat($date, self::FORMAT);
    }

    public static function fromFormat(string $date, string $format): self
    {
        Assertion::date($date, $format, 'Not a valid date');

        $datetime = new self();
        $datetime->updatedAt = new DateTime($date);

        return $datetime;
    }

    public static function generate(): self
    {
        $datetime = new self();
        $datetime->updatedAt = new DateTime();

        return $datetime;
    }

    public static function empty(): self
    {
        return new self();
    }

    public function __toString(): string
    {
        return $this->toString() ?: '';
    }

    public function jsonSerialize(): ?string
    {
        return $this->toString();
    }
}
