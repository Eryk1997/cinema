<?php

declare(strict_types=1);

namespace App\Tests\Modules\Room\Domain\Entity;

use App\Modules\Room\Domain\Embeddable\Name;
use App\Modules\Room\Domain\Entity\Room;
use App\Modules\Room\Seat\Domain\Embeddable\Column;
use App\Modules\Room\Seat\Domain\Embeddable\Row;
use App\Modules\Room\Seat\Domain\Entity\Seat;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

/**
 * @internal
 *
 * @coversNothing
 */
class RoomTest extends TestCase
{
    public function test_should_detect_duplicate_seat_position(): void
    {
        $room = new Room(Uuid::v7(), new Name('Sala 1'));

        $firstSeatId = Uuid::v7();
        $firstSeat = new Seat($firstSeatId, new Row(5), new Column(10));
        $room->addSeat($firstSeat);

        $secondSeatId = Uuid::v7();
        $duplicateSeat = new Seat($secondSeatId, new Row(5), new Column(10));

        $exists = $room->existEqualSeat($duplicateSeat);

        $this->assertTrue($exists, 'Room should detect that a seat with the same row and column already exists.');
    }

    public function test_should_not_detect_duplicate_for_different_positions(): void
    {
        $room = new Room(Uuid::v7(), new Name('Sala 1'));
        $room->addSeat(new Seat(Uuid::v7(), new Row(1), new Column(1)));

        $newSeat = new Seat(Uuid::v7(), new Row(1), new Column(2));

        $exists = $room->existEqualSeat($newSeat);

        $this->assertFalse($exists, 'Room should not detect duplicate for different row/column positions.');
    }
}
