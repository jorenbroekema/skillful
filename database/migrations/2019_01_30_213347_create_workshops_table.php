<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/* phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace */
class CreateWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->integer('difficulty');
            $table->unsignedInteger('owner_id')->nullable();
            $table->unsignedInteger('group_id')->nullable();
            $table->boolean('public')->default(false);
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->timestamps();
        });
    }

    /*
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workshops');
    }
}
