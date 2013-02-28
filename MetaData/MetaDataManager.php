<?php

namespace Astina\Bundle\SeoBundle\MetaData;

use Astina\Bundle\SeoBundle\Entity\PageMetaData;
use Astina\Bundle\SeoBundle\Entity\PageMetaDataRepository;
use Doctrine\ORM\EntityManager;

class MetaDataManager
{
    /**
     * @var PageMetaDataRepository
     */
    private $pageMetaDataRepo;

    /**
     * @var EntityManager
     */
    private $em;

    function __construct(PageMetaDataRepository $pageMetaDataRepo, EntityManager $em)
    {
        $this->pageMetaDataRepo = $pageMetaDataRepo;
        $this->em = $em;
    }

    /**
     * @param $path
     * @param string $title
     * @param string $description
     * @param string $keywords
     */
    public function setPageMetaData($path, $title = null, $description = null, $keywords = null)
    {
        $pageMetaData = $this->pageMetaDataRepo->findOneByPath($path);

        if (null == $pageMetaData) {
            $pageMetaData = new PageMetaData();
            $pageMetaData->setPath($path);
            $this->em->persist($pageMetaData);
        }

        $pageMetaData->setTitle($title);
        $pageMetaData->setDescription($description);
        $pageMetaData->setKeywords($keywords);

        $this->em->flush();
    }
}
