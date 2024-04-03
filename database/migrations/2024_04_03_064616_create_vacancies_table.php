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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id()->unique();
            $table->foreignId("year_id")->constrained()->casecadeOnDelete();
            $table->integer("adv_number");
            $table->string("service");
            $table->string("sub_service");
            $table->string("sup_service");
            $table->string("post");
            $table->string("qualification");
            $table->integer("total_demand");
            $table->date("min_date_to_pay");
            $table->date("double_date_to_pay");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
