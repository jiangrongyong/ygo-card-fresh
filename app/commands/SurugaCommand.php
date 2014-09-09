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
        $notifications = [];
        foreach ($jobs as $job) {
            try {
                $crawler = $client->request('GET', $job->url);
                $node = $crawler->filter('table .text2 .link')->eq(0);

                $ptext = $crawler->filter('#main2>p')->text();
                //preg_match('/[0-9]+/', $ptext, $count);
                //$count = $crawler->filter('#main2>p')->text();
                if (strlen($ptext) == 0) {
                    $count = 0;
                } else {
                    $count = substr($ptext, 13, 1);
                }
                //Log::info('count:' . $count);

                $link = $node->attr('href');
                if ($link !== $job->last_name || $count !== $job->last_count) {
                    $job->last_name = $link;
                    $job->last_count = $count;
                    $job->save();

                    $notifications[] = $job;
                }

            } catch (Exception $e) {
            }
        }

        //test....job->last_count
        //#main2 > p

        Log::info('Suruga check.');
        if (count($notifications) !== 0) {
            Mail::send('emails.suruga.index', compact('notifications'), function ($message) {
                $message->to('fflzb@vip.qq.com', 'ffwing')->subject('Suruga Updates');
            });
            Log::info('Email was sended.');
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
