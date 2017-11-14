<?php

namespace ZelmadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pfee
 *
 * @ORM\Table(name="pfee")
 * @ORM\Entity(repositoryClass="ZelmadBundle\Repository\PfeeRepository")
 */
class Pfee
{
    /**
     * @ORM\ManyToOne(targetEntity="Societe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $societe;
	
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateDebut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Datefin", type="date")
     */
    private $datefin;

    /**
     * @var string
     *
     * @ORM\Column(name="Sujet", type="string", length=255)
     */
    private $sujet;

    /**
     * @var int
     *
     * @ORM\Column(name="Duree", type="integer")
     */
    private $duree;

    /**
     * @var string
     *
     * @ORM\Column(name="SchoolYear", type="string", length=255)
     */
    private $schoolYear;
	
	 /**
     * @var int
     *
     * @ORM\Column(name="nbreeleve", type="integer")
     */
    private $nbreeleve;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Pfee
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set datefin
     *
     * @param \DateTime $datefin
     * @return Pfee
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime 
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set sujet
     *
     * @param string $sujet
     * @return Pfee
     */
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;

        return $this;
    }

    /**
     * Get sujet
     *
     * @return string 
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * Set duree
     *
     * @param integer $duree
     * @return Pfee
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return integer 
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set schoolYear
     *
     * @param string $schoolYear
     * @return Pfee
     */
    public function setSchoolYear($schoolYear)
    {
        $this->schoolYear = $schoolYear;

        return $this;
    }

    /**
     * Get schoolYear
     *
     * @return string 
     */
    public function getSchoolYear()
    {
        return $this->schoolYear;
    }

    /**
     * Set societe
     *
     * @param \ZelmadBundle\Entity\Societe $societe
     * @return Pfee
     */
    public function setSociete(\ZelmadBundle\Entity\Societe $societe)
    {
        $this->societe = $societe;

        return $this;
    }

    /**
     * Get societe
     *
     * @return \ZelmadBundle\Entity\Societe 
     */
    public function getSociete()
    {
        return $this->societe;
    }
	
	public function __construct()
    {
	    $this->nbreeleve = 2;
    }

    /**
     * Set nbreeleve
     *
     * @param integer $nbreeleve
     * @return Pfee
     */
    public function setNbreeleve($nbreeleve)
    {
        $this->nbreeleve = $nbreeleve;

        return $this;
    }

    /**
     * Get nbreeleve
     *
     * @return integer 
     */
    public function getNbreeleve()
    {
        return $this->nbreeleve;
    }
}
