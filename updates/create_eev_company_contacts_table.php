<?php namespace EEV\Company\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateEevCorpcoreContacts extends Migration
{
    public function up()
    {
        Schema::create('eev_company_contacts', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title', 1024)->nullable();
            $table->string('text', 1024)->nullable();
            $table->string('link', 1024)->nullable();
            $table->string('type', 32)->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('eev_company_contacts');
    }
}
