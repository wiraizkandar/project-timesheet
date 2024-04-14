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
        Schema::create('timesheets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_user_id')->index();
            $table->date('date')->index();
            $table->unsignedInteger('total_minutes')->default(0);
            $table->text('summary_of_work');
            $table->timestamps();

            $table->foreign('project_user_id')->references('id')->on('project_users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timesheets');
    }
};
