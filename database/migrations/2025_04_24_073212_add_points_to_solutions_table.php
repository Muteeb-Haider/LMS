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
        Schema::table('solutions', function (Blueprint $table) {
            $table->integer('points')->nullable()->after('solution_text');
            $table->timestamp('evaluated_at')->nullable()->after('points');
        });
    }

    public function down(): void
    {
        Schema::table('solutions', function (Blueprint $table) {
            $table->dropColumn(['points', 'evaluated_at']);
        });
    }

    /**
     * Reverse the migrations.
     */

};
