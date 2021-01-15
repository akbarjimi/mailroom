<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letters', function (Blueprint $table) {
            $table->engine = 'myisam';

            $table->uuid('id');
            $table->unsignedBigInteger( 'lettertype_id');
            $table->unsignedBigInteger( 'project_id');
            $table->unsignedBigInteger( 'user_id');
            $table->bigInteger('row', false, true);

            $table->primary(['lettertype_id', 'project_id', 'row'],'primary_key');

            $table->char('title', 255);
            $table->date('date');
            $table->timestamps();

        });

        Schema::table('letters', function (Blueprint $blueprint) {
            $blueprint->bigInteger('row', true, true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('letters');
    }
}
