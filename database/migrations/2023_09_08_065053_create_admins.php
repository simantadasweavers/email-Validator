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
        Schema::create('admins', function (Blueprint $table) {
            $table->id('adminid')->unsigned(false);
            $table->string('adminname');
            $table->string('adminpass');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE admins MODIFY COLUMN adminid bigint(10)");
        DB::statement("ALTER TABLE admins MODIFY COLUMN adminname varchar(200) NOT NULL");
        DB::statement("ALTER TABLE admins MODIFY COLUMN adminpass varchar(250) NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
