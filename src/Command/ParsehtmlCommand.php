<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DomCrawler\Crawler;

class ParsehtmlCommand extends Command
{
    protected static $defaultName = 'app:parse-html';

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $url = 'https://www.foto-koeberl-graz.at/blog/';
        $html = file_get_contents($url);
        $crawler = new Crawler(null, $url);
        $crawler->addHtmlContent($html, 'UTF-8');
        $crawler->filterXPath('//main/article')->each(function (Crawler $node, $i) {
            var_dump($node->children('div > a')->attr('href'));
            return $node->attr('href');
        });


//        $post = $crawler->filter('body')->children('article');
//        $posts = $crawler->filterXPath('//article[contains(@id, "post-")]');
        /*$posts = $crawler->filterXPath('//article/div')->children('a')
            ->attr('href');*/



        return 0;
    }
}
