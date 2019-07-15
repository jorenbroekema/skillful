<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/* phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace */
class CreateBugReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bug_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('author_id')->default(0);
            $table->string('name')->default('');
            $table->string('url');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bug_reports');
    }
}
