<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $type = new Type();
            if ($i === 0) {
                $type->setLabel('heating');
            }
            if ($i === 1) {
                $type->setLabel('pipe');
            }
            if ($i === 2) {
                $type->setLabel('thermostatic_valve');
            }
            if ($i === 3) {
                $type->setLabel('valve');
            }
            if ($i === 4) {
                $type->setLabel('circulation_pump');
            }
            $manager->persist($type);
            $manager->flush();
        }

    }
}
