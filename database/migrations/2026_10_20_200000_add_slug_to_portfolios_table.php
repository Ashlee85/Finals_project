<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->string('slug', 120)->nullable()->unique()->after('status');
        });

        // Give already-saved portfolios a public link name.
        DB::table('portfolios')
            ->where('status', 'saved')
            ->whereNull('slug')
            ->orderBy('id')
            ->get()
            ->each(function ($row) {
                do {
                    $slug = (Str::slug($row->full_name) ?: 'portfolio')
                        . '-' . Str::lower(Str::random(6));
                } while (DB::table('portfolios')->where('slug', $slug)->exists());

                DB::table('portfolios')->where('id', $row->id)->update(['slug' => $slug]);
            });
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};