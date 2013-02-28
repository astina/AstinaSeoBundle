<?php

namespace Astina\Bundle\SeoBundle\Command;

use Astina\Bundle\SeoBundle\MetaData\MetaDataManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PageMetaDataCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('astina:seo:page-meta-data')
            ->setDescription('Edit page meta data')
            ->addArgument('path', InputArgument::REQUIRED, 'Page path starting with "/"')
            ->addArgument('title', InputArgument::OPTIONAL, 'Page title')
            ->addArgument('description', InputArgument::OPTIONAL, 'Meta description')
            ->addArgument('keywords', InputArgument::OPTIONAL, 'Meta keywords')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $input->getArgument('path');
        $title = $input->getArgument('title');
        $description = $input->getArgument('description');
        $keywords = $input->getArgument('keywords');

        /** @var $metaDataManager MetaDataManager */
        $metaDataManager = $this->getContainer()->get('astina_seo.meta_data_manager');

        $metaDataManager->setPageMetaData($path, $title, $description, $keywords);

        $output->writeln('<info>OK</info>');
    }
}
