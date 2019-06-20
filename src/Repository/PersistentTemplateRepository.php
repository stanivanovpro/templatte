<?php

namespace App\Repository;

use App\Entity\PersistentTemplate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * Class PersistentTemplateRepository
 */
class PersistentTemplateRepository extends ServiceEntityRepository
{
    /**
     * @param PersistentTemplate $template
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(PersistentTemplate $template)
    {
        $this->_em->persist($template);
        $this->_em->flush($template);
    }
}