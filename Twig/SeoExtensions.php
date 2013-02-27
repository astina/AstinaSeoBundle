<?php

namespace Astina\Bundle\SeoBundle\Twig;

use Astina\Bundle\SeoBundle\Entity\PageMetaData;
use Astina\Bundle\SeoBundle\Entity\PageMetaDataRepository;
use Symfony\Component\HttpFoundation\Request;

class SeoExtensions extends \Twig_Extension
{
    /**
     * @var PageMetaDataRepository
     */
    private $repo;

    /**
     * @var string
     */
    private $metaTagsTemplate;

    /**
     * @var \Twig_Environment
     */
    private $environment;

    function __construct(PageMetaDataRepository $repo, $metaTagsTemplate)
    {
        $this->repo = $repo;
        $this->metaTagsTemplate = $metaTagsTemplate;
    }

    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'seo_meta_data' => new \Twig_Function_Method($this, 'getPageMetaData'),
            'seo_meta_tags' => new \Twig_Function_Method($this, 'renderPageMetaTags', array('is_safe' => array('html'))),
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param string $defaultTitle
     * @param array $defaults
     * @param string $titleSuffix
     * @return PageMetaData
     */
    public function getPageMetaData(Request $request, $defaultTitle = null, array $defaults = array(), $titleSuffix = null)
    {
        $pageMetaData = $this->repo->findOneByRequest($request);

        if (null == $pageMetaData) {
            $pageMetaData = new PageMetaData();
        }

        if (null == $pageMetaData->getTitle()) {
            $pageMetaData->setTitle($defaultTitle);
        }
        if (null == $pageMetaData->getDescription() && isset($defaults['description'])) {
            $pageMetaData->setDescription($defaults['description']);
        }
        if (null == $pageMetaData->getKeywords() && isset($defaults['keywords'])) {
            $pageMetaData->setKeywords($defaults['keywords']);
        }

        if ($titleSuffix) {
            $pageMetaData->setTitle($pageMetaData->getTitle() . ($pageMetaData->getTitle() ? ' - ' : '') . $titleSuffix);
        }

        return $pageMetaData;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param string $defaultTitle
     * @param array $defaults
     * @param string $titleSuffix
     * @return string
     */
    public function renderPageMetaTags(Request $request, $defaultTitle = null, array $defaults = array(), $titleSuffix = null)
    {
        $pageMetaData = $this->getPageMetaData($request, $defaultTitle, $defaults, $titleSuffix);

        return $this->renderTemplate($this->metaTagsTemplate, array('page_meta_data' => $pageMetaData));
    }

    private function renderTemplate($template, array $params)
    {
        if (!$template instanceof \Twig_Template) {
            $template = $this->environment->loadTemplate($template);
        }

        return $template->render($params);
    }

    public function getName()
    {
        return 'astina_seo';
    }
}
