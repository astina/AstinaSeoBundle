<?php

namespace Astina\Bundle\SeoBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;

class PageMetaDataRepository extends EntityRepository
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return PageMetaData
     */
    public function findOneByRequest(Request $request)
    {
        $pageMetaDatas = $this->createQueryBuilder('pmd')
            ->where('pmd.path = :path')
            ->andWhere('pmd.hostname is null or pmd.hostname = :hostname')
            ->setParameter('path', $request->getPathInfo())
            ->setParameter('hostname', $request->getHost())
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;

        if (count($pageMetaDatas) == 0) {
            return null;
        }

        return current($pageMetaDatas);
    }

    /**
     * @param $path
     * @return PageMetaData
     */
    public function findOneByPath($path)
    {
        return $this->findOneBy(array('path' => $path));
    }
}
