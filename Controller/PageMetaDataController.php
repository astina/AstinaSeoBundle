<?php

namespace Astina\Bundle\SeoBundle\Controller;

use Astina\Bundle\SeoBundle\Entity\PageMetaData;
use Astina\Bundle\SeoBundle\Entity\PageMetaDataRepository;
use Astina\Bundle\SeoBundle\Form\PageMetaDataType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageMetaDataController extends Controller
{
    /**
     * @param $path
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($path)
    {
        $pageMetaData = $this->getPageMetaDataRepository()->findOneBy(array('path' => $path));
        if (null == $pageMetaData) {
            $pageMetaData = new PageMetaData();
            $pageMetaData->setPath($path);
        }

        $form = $this->createForm(new PageMetaDataType(), $pageMetaData);

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {

                $manager = $this->getDoctrine()->getManager();
                $manager->persist($pageMetaData);
                $manager->flush();

                return $this->redirect($path); // XXX not so nice
            }
        }

        return $this->render('AstinaSeoBundle:PageMetaData:edit.html.twig', array(
            'page_meta_data' => $pageMetaData,
            'form' => $form->createView(),
        ));
    }

    /**
     * @return PageMetaDataRepository
     */
    private function getPageMetaDataRepository()
    {
        return $this->get('astina_seo.repository.page_meta_data');
    }
}
