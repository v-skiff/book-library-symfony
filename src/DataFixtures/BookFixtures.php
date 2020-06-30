<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends BaseFixture implements OrderedFixtureInterface
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Book::class, 75, function (Book $book, $count) use ($manager) {
            $book->setTitle(ucfirst($this->faker->word));
            $book->setDescription($this->faker->paragraph);
            $book->setAuthor($this->getReference(Author::class.'_'.$this->faker->numberBetween(0, 14)));
        });

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
