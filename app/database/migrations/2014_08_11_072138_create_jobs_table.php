<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration {

    public function up() {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->string('last_name')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    public function down() {
        Schema::dropIfExists('jobs');
    }
}
