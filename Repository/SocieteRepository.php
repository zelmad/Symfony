<?php

namespace ZelmadBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * SocieteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SocieteRepository extends EntityRepository
{
	public function getLikeQueryBuilder($pattern)
	{
		return $this
			->createQueryBuilder('s')
			->where('s.nom LIKE :pattern')
			->setParameter('pattern', $pattern);
	}
}
