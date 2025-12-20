<?php

declare(strict_types=1);

namespace App\Tests\Modules\Room\Api\Controller;

use App\Modules\Room\Domain\Embeddable\Name;
use App\Modules\Room\Domain\Entity\Room;
use App\Modules\User\Domain\Entity\User;
use App\Modules\User\Domain\Enums\Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Uid\Uuid;

/**
 * @internal
 *
 * @coversNothing
 */
class DeleteRoomApiTest extends WebTestCase
{
    private EntityManagerInterface $entityManager;
    private $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->entityManager = self::getContainer()->get('doctrine')->getManager();
    }

    public function test_admin_can_delete_room(): void
    {
        $id = Uuid::v7();
        $uniqueName = 'Sala do usuniecia'.uniqid();
        $room = new Room($id, new Name($uniqueName));

        $this->entityManager->persist($room);
        $admin = $this->createAdminUser();
        $this->client->loginUser($admin);
        $this->entityManager->flush();

        $roomInDb = $this->entityManager->getRepository(Room::class)->find($id);
        $this->assertNotNull($roomInDb, 'Room should exist in DB before deletion.');

        $this->client->request('DELETE', '/api/rooms/'.$id->toRfc4122());

        $this->assertResponseIsSuccessful();

        $this->entityManager->clear();

        $deletedRoom = $this->entityManager->getRepository(Room::class)->find($id);
        $this->assertNull($deletedRoom, 'Room should be removed from the database.');
    }

    public function test_non_admin_cannot_delete_room(): void
    {
        $id = Uuid::v7();
        $uniqueName = 'Sala Chroniona '.uniqid();
        $room = new Room($id, new Name($uniqueName));
        $this->entityManager->persist($room);
        $this->entityManager->flush();

        $this->client->request('DELETE', '/api/rooms/'.$id->toRfc4122());

        $this->assertResponseStatusCodeSame(401);
    }

    private function createAdminUser(): User
    {
        $uniqueEmail = sprintf('admin%s@cinema.com', uniqid());
        $user = new User(
            id: Uuid::v7(),
            fistName: 'eryk',
            lastName: 'janocha',
            email: $uniqueEmail,
            type: Type::AMIN,
        );

        $user->setPassword('test123');

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}
