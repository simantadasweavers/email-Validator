<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('allemails', function (Blueprint $table) {
            $table->id('emailid')->unsigned(false);
            $table->integer('clientid');
            $table->string('name');
            $table->string('date');
            $table->string('time');
            $table->timestamps();
        });

        // modify column
        DB::statement("ALTER TABLE allemails MODIFY COLUMN emailid bigint(20) AUTO_INCREMENT,AUTO_INCREMENT=1");
        DB::statement("ALTER TABLE allemails MODIFY COLUMN clientid bigint(20) NOT NULL");
        DB::statement("ALTER TABLE allemails ADD FOREIGN KEY(clientid) REFERENCES visitors(enrollno)");
        DB::statement("ALTER TABLE allemails MODIFY COLUMN name varchar(255) NOT NULL");
        DB::statement("ALTER TABLE allemails MODIFY COLUMN date date NOT NULL");
        DB::statement("ALTER TABLE allemails MODIFY COLUMN time varchar(200) NOT NULL");
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allemails');
    }
};
