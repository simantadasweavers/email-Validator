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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id('enrollno')->unsigned(false);
            $table->string('name');
            $table->integer('phone');
            $table->string('email');
            $table->string('passwd');
            $table->date('date');
            $table->string('time');
            $table->string('loc');
            $table->timestamps();
        });
        
        // modifty script
        DB::statement("ALTER TABLE visitors MODIFY COLUMN enrollno bigint(20) AUTO_INCREMENT,AUTO_INCREMENT=1");
        DB::statement("ALTER TABLE visitors MODIFY COLUMN name varchar(250) NOT NULL");
        DB::statement("ALTER TABLE visitors MODIFY COLUMN phone bigint(15) NOT NULL");
        DB::statement("ALTER TABLE visitors MODIFY COLUMN email varchar(250) NOT NULL");
        DB::statement("ALTER TABLE visitors MODIFY COLUMN passwd varchar(250) NOT NULL");
        DB::statement("ALTER TABLE visitors MODIFY COLUMN date date NOT NULL");
        DB::statement("ALTER TABLE visitors MODIFY COLUMN time varchar(100) NOT NULL");
        DB::statement("ALTER TABLE visitors MODIFY COLUMN loc varchar(100) NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
