<?php

namespace AppBundle\Command;

use AppBundle\Entity\Countries;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Goutte\Client;

class CreateUserCommand extends Command
{

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:create-users')

            // the short description shown while running "php bin/console list"
            ->setDescription('Creates new users.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp("This command allows you to create users...")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new Client();

        // Go to the booking.com website
        $crawler = $client->request('GET', 'http://www.booking.com/country.en-gb.html');

        $crawler = $crawler->filter('body#b2countryPage > div#bodyconstraint > div#bodyconstraint-inner > div.lp_flexible_layout_content_wrapper > div#countryTmpl > div.block_third > div.block_header');

        foreach ($crawler as $domElement) {

            //var_dump($domElement->getElementsByTagName('h2')->item(0)->textContent);

            var_dump($domElement->getElementsByTagName('span')->item(0)->textContent);

            $countries = new Countries();


            $countries->setCountry($domElement->getElementsByTagName('h2')->item(0)->textContent);
            $countries->setHotels($domElement->getElementsByTagName('span')->item(0)->textContent);

            $em = $this->getDoctrine()->getManager();

            $em->persist($countries);

            $em->flush();

          }
     }
}