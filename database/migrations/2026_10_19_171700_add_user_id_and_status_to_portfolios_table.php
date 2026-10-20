<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->nullable()
                ->after('id')
                ->constrained()
                ->nullOnDelete();

            $table->string('status', 20)
                ->default('draft')
                ->after('selected_template');
        });

        // Rows that already exist were saved by the old flow, so mark them saved.
        DB::table('portfolios')->update(['status' => 'saved']);
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            $table->dropColumn('status');
        });
    }
};