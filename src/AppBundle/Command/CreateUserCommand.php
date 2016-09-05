<?php

namespace AppBundle\Command;


use AppBundle\Entity\City;
use AppBundle\Entity\Countries;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Goutte\Client as GoutteClient;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Helper\ProgressBar;
use GuzzleHttp\Client;

class CreateUserCommand extends ContainerAwareCommand

{

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('booking:parse-hotels')
            // the short description shown while running "php bin/console list"
            ->setDescription('Parsing and saving new hotels.')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp("This command allows you to parsing and saving new hotels...");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new GoutteClient();

        // Go to the booking.com website
        $crawler = $client->request('GET', 'http://www.booking.com/country.en-gb.html');

        $crawler = $crawler->filter('body#b2countryPage > div#bodyconstraint > div#bodyconstraint-inner > div.lp_flexible_layout_content_wrapper > div#countryTmpl > div.block_third > div.block_header ');

        $progress = new ProgressBar($output,$crawler->count());

        $progress->start();

        $sumHotels = 0;

        $sumCountries = 0;

        $doctrine = $this->getContainer()->get('doctrine');

        $em = $doctrine->getManager();

        $cmd = $em->getClassMetadata(Countries::class);
        $connection = $em->getConnection();
        $connection->beginTransaction();
        try {
            $db = $connection->getDatabasePlatform();
            $connection->query('SET FOREIGN_KEY_CHECKS=0');
            $sql = $db->getTruncateTableSql($cmd->getTableName());
            $connection->executeUpdate($sql);
            $connection->query('SET FOREIGN_KEY_CHECKS=1');
        }
        catch (\Exception $e) {
            $connection->rollback();
        }

        // Parsing countries
        foreach ($crawler as $domElement) {

            $Country = $domElement->getElementsByTagName('h2')->item(0)->textContent;

            $hotels = $domElement->getElementsByTagName('span')->item(0)->textContent;

            $integer = (int)$hotels;

            $sumHotels = $integer + $sumHotels;

            $sumCountries = $sumCountries + 1;

            $link = $domElement->getElementsByTagName('a')->item(0);

            $citiesHTML = $client->request('GET', 'http://www.booking.com/country/gb.en-gb.html?label=gen173nr-1DCAIoggJCAlhYSAliBW5vcmVmaOkBiAEBmAEuuAEPyAEP2AED6AEB-AECqAID;sid=229aa607aea7d66975f8009f521b5932;inac=0&');

            $cities = $citiesHTML->filter('body > div.slinks > div.in-and-around.clearfix > ul.ia-body.clearfix > li.ia-section.active');

            var_dump($cities->count());

            // Parsing cities
            foreach ($cities as $city){

                $city = $domElement->getElementsByTagName('li')->item(0)->textContent;

                var_dump($city);

            }

            exit();
            $countries = new Countries();
            $countries->setCountry($Country);
            $countries->setHotels($integer);

            $em->persist($countries);

            $progress->advance();
        }

        $em->flush();


        $progress->finish();

        $output->writeln('');

        $output->writeln('All is ok. We are saving<info> '.$sumCountries.' </info>countries and<info> '.$sumHotels. ' </info>hotels');
    }
}