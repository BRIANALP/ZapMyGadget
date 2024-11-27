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
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Employer::class);
            $table->string('device_model');
            $table->string('issue');
            $table->foreignIdFor(App\Models\User::class);
            $table->string('response')->nullable();
            $table->integer('billing')->nullable();
            $table->integer('approval')->nullable();
            $table->string('repair_status')->nullable();
            $table->timestamps();
            $table->softDeletes();//its nullable by default
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
