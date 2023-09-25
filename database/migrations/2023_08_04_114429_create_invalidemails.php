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
        Schema::create('invalidemails', function (Blueprint $table) {
            $table->id();
                $table->integer('clientid');
                $table->string('name');
                $table->date('date');
                $table->string('time');
                $table->timestamps();
        });
        
        DB::statement("ALTER TABLE invalidemails MODIFY COLUMN id bigint(20) AUTO_INCREMENT,AUTO_INCREMENT=1");
        DB::statement("ALTER TABLE invalidemails MODIFY COLUMN clientid bigint(20) NOT NULL");
        DB::statement("ALTER TABLE invalidemails ADD FOREIGN KEY (clientid) REFERENCES visitors(enrollno)");
        DB::statement("ALTER TABLE invalidemails MODIFY COLUMN name varchar(250) NOT NULL");
        DB::statement("ALTER TABLE invalidemails MODIFY COLUMN date date NOT NULL");
        DB::statement("ALTER TABLE invalidemails MODIFY COLUMN time varchar(100) NOT NULL");
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invalidemails');
    }
};
