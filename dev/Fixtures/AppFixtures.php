<?php

declare(strict_types=1);

namespace App\Dev\Fixtures;

use App\Modules\Room\Domain\Embeddable\Name;
use App\Modules\Room\Domain\Entity\Room;
use App\Modules\Room\Seat\Domain\Embeddable\Column;
use App\Modules\Room\Seat\Domain\Embeddable\Row;
use App\Modules\Room\Seat\Domain\Entity\Seat;
use App\Modules\Screening\Domain\Entity\Screening;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $room = new Room(
            Uuid::v7(),
            new Name('Sala Premierowa')
        );

        for ($r = 1; $r <= 5; ++$r) {
            for ($c = 1; $c <= 10; ++$c) {
                $seat = new Seat(
                    Uuid::v7(),
                    new Row($r),
                    new Column($c)
                );
                $room->addSeat($seat);
                $manager->persist($seat);
            }
        }
        $manager->persist($room);

        $screening = new Screening(
            Uuid::v7(),
            'Gladiator 2',
            new \DateTimeImmutable('2025-12-25 20:00:00'),
            $room
        );
        $manager->persist($screening);

        $manager->flush();
    }
}
