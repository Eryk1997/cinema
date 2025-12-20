<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Domain\Entity;

use App\Modules\Room\Seat\Domain\Entity\Seat;
use App\Modules\Screening\Domain\Entity\Screening;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Uid\Uuid;

#[Entity]
#[Table(name: 'reservations')]
class Reservation
{
    /** @var Collection<int, Seat> */
    #[ManyToMany(targetEntity: Seat::class)]
    #[JoinTable(name: 'reservation_seats')]
    private Collection $seats;

    #[Column(type: Types::DATE_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;

    public function __construct(
        #[Id]
        #[Column(type: 'uuid_mariadb', unique: true)]
        private Uuid $id,
        #[Column(type: Types::STRING)]
        private string $customerEmail,
        #[ManyToOne(targetEntity: Screening::class)]
        #[JoinColumn(nullable: false)]
        private Screening $screening,
    ) {
        $this->seats = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getCustomerEmail(): string
    {
        return $this->customerEmail;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getScreening(): Screening
    {
        return $this->screening;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function addSeat(Seat $seat): void
    {
        if ($seat->getRoom()->getId() !== $this->screening->getRoom()->getId()) {
            throw new \DomainException('Seat does not belong to the screening room.');
        }

        if (!$this->seats->contains($seat)) {
            $this->seats->add($seat);
        }
    }
}
