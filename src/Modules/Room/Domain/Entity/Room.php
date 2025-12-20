<?php

declare(strict_types=1);

namespace App\Modules\Room\Domain\Entity;

use App\Modules\Room\Domain\Embeddable\Name;
use App\Modules\Room\Seat\Domain\Entity\Seat;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embedded;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Uid\Uuid;

#[Entity]
#[Table(name: 'rooms')]
#[HasLifecycleCallbacks]
class Room
{
    /** @var Collection<int, Seat> */
    #[OneToMany(targetEntity: Seat::class, mappedBy: 'room', cascade: ['persist'], orphanRemoval: true)]
    private Collection $seats;

    public function __construct(
        #[Id]
        #[Column(type: 'uuid_mariadb', unique: true)]
        private Uuid $id,
        #[Embedded(class: Name::class, columnPrefix: false)]
        private Name $name,
    ) {
        $this->seats = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name->getValue();
    }

    /** @return Collection<int, Seat> */
    public function getSeats(): Collection
    {
        return $this->seats;
    }

    public function addSeat(Seat $seat): void
    {
        if (!$this->seats->contains($seat)) {
            $this->seats->add($seat);
            $seat->setRoom($this);
        }
    }

    public function existEqualSeat(Seat $seat): bool
    {
        return $this->seats->exists(
            fn ($key, Seat $currentSeat) => $currentSeat->getRow()->getNumber() === $seat->getRow()->getNumber()
            && $currentSeat->getColumn()->getNumber() === $seat->getColumn()->getNumber()
            && $currentSeat->getId() !== $seat->getId()
        );
    }

    public function setName(Name $name): void
    {
        $this->name = $name;
    }

    public function removeSeat(Seat $seat): void
    {
        if ($this->seats->contains($seat)) {
            $this->seats->removeElement($seat);
        }
    }
}
