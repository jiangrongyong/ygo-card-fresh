<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Goutte\Client;

class SurugaCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'suruga';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return \SurugaCommand
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire() {
        $client = new Client();

        $jobs = Job::get();
        foreach ($jobs as $job) {
            $crawler = $client->request('GET', $job->url);
            $crawler->filter('table .text2 .link:first-child')->each(function ($node) use ($job) {
                echo $node->html();
                $link = $node->attr('href');
                $job->last_name = $link;
                $job->save();
            });
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments() {
        return array(
            array('example', InputArgument::OPTIONAL, 'An example argument.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() {
        return array(
            array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
        );
    }

}
