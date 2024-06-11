<?php

namespace App\Factory\DataFixtures;

use App\Factory\Admin;
use App\Factory\User;
use App\Factory\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\AdminFactory;
use App\Factory\UserFactory;
use App\Factory\EventFactory;

class AppFixtures extends Fixture{
    
    public function load(ObjectManager $manager){
        AdminFactory::new()->createMany(20);
        UserFactory::new()->createMany(20);
        EventFactory::new()->createMany(20);
    }
  
}