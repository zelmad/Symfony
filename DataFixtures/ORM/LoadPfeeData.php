<?php
// src/OC/PlatformBundle/DataFixtures/ORM/LoadPfeeData.php

namespace ZelmadBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZelmadBundle\Entity\Pfee;

class LoadPfeeData extends AbstractFixture implements OrderedFixtureInterface
{
  public function load(ObjectManager $manager)
  {
    $pfee = new Pfee();
    $pfee->setSociete($this->getReference('societe'));
    $pfee->setDateDebut(new \DateTime('06-03-2017'));
    $pfee->setDateFin(new \DateTime('06-09-2017'));
    $pfee->setSujet("Developpement symfony");
    $pfee->setDuree("6");
    $pfee->setSchoolYear("2016-2017");
	
    $manager->persist($pfee);
    $manager->flush();
  }
  
  public function getOrder()
  {
    return 2;
  }
}