<?php

namespace AppBundle\Command;

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Goutte\Client;

class CreateUserCommand extends Command
{
    /**
     * @Route("configure/1", name="configure")
     */
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

    /**
     * @Route("execute/{productId}", name="execute")
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new Client();

        // Go to the symfony.com website
        $crawler = $client->request('GET', 'http://www.booking.com/country.en-gb.html');

        $html = <<<'HTML'
<!DOCTYPE html>
<html>
    <body>
        <div class="lp__flexible_layout_content_wrapper"</div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
        <div class="block_third" </div>
    </body>
</html>
HTML;

        $crawler = new Crawler($html);

        foreach ($crawler as $domElement) {
            var_dump($domElement->nodeName);
          }
     }
}