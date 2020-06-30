<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AuthorFixtures extends BaseFixture implements OrderedFixtureInterface
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Author::class, 20, function (Author $author, $count) {
            $author->setName($this->faker->name);
        });

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
