<?php
// src/OC/PlatformBundle/DataFixtures/ORM/LoadSocieteData.php

namespace ZelmadBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZelmadBundle\Entity\Societe;

class LoadSocieteData extends AbstractFixture implements OrderedFixtureInterface
{
  public function load(ObjectManager $manager)
  {
    $societe = new Societe();
    $societe->setNom("Synaptique");
    $societe->setTel("0567876765");
    $societe->setEmail("contact@synaptique.ma");
	
    $manager->persist($societe);
    $manager->flush();
	
	$this->addReference('societe', $societe);
  }
  
  public function getOrder()
  {
    return 1;
  }
}