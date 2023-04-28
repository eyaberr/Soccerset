<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('child_group', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();;
            $table->foreignId('group_id')->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_group');
    }
};
