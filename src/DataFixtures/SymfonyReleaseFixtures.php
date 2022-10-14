<?php

namespace App\DataFixtures;

use App\Entity\SymfonyRelease;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SymfonyReleaseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $symfonyRelease1 = new SymfonyRelease();
         $symfonyRelease1->setName("5.4");
         $symfonyRelease1->setIsLongTermSupport(true);

         $symfonyRelease2 = new SymfonyRelease();
         $symfonyRelease2->setName("6.1");
         $symfonyRelease2->setIsStable(true);

         $symfonyRelease3 = new SymfonyRelease();
         $symfonyRelease3->setName("6.2");

         $manager->persist($symfonyRelease1);
         $manager->persist($symfonyRelease2);
         $manager->persist($symfonyRelease3);

         $manager->flush();
    }
}
