<?php

use App\Models\Category;
use App\Models\Nominee;
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
        Schema::create('selected_candidates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Category::class);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Nominee::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selected_candidates');
    }
};
