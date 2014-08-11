<?php

class JobSeeder extends DatabaseSeeder {

    public function run() {
        $job = new Job();
        $job->url = 'http://www.suruga-ya.jp/search?search_word=G5&category=501080040&rankBy=modificationTime%3Adescending&inStock=Off&cookie=true';
        $job->save();

        $job = new Job();
        $job->url = 'http://www.suruga-ya.jp/search?category=501080040&inStock=Off&search_word=G7+UR';
        $job->save();

        $job = new Job();
        $job->url = 'http://www.suruga-ya.jp/search?category=501080040&inStock=Off&search_word=G4+%E3%83%91%E3%83%A9';
        $job->save();
    }

}