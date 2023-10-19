<?php

use App\Models\User;
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
        Schema::create('voters', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignIdFor(User::class);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('other_name')->nullable();
            $table->string('gender');
            $table->string('email')->unique();
            $table->string('country_code');
            $table->string('mobile_number')->unique();
            $table->string('mdc_number')->unique();
            $table->string('login_code')->nullable();
            $table->dateTime('login_code_date')->nullable();
            $table->string('2fa_code')->nullable();
            $table->dateTime('2fa_code_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voters');
    }
};
