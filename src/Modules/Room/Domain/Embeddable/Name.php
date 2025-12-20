<?php

namespace App\Modules\Room\Domain\Embeddable;

use App\Modules\Room\Domain\Exception\RoomException;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
class Name
{
    private const MAX_LENGTH = 255;

    public function __construct(
        #[Column(type: Types::STRING, length: self::MAX_LENGTH, unique: true)]
        private string $value,
    ) {
        if (strlen($this->value) > self::MAX_LENGTH) {
            throw new RoomException('room.name.max_length', ['%max%' => self::MAX_LENGTH]);
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
