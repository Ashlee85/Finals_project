
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();

            // Personal Information
            $table->string('full_name');
            $table->string('profile_picture')->nullable();
            $table->string('email');
            $table->string('contact_number');
            $table->string('address');
            $table->text('about_me');

            // Portfolio Information
            $table->text('education');
            $table->text('skills');
            $table->text('projects')->nullable();
            $table->text('work_experience')->nullable();
            $table->text('social_links')->nullable();

            // 1 = Simple, 2 = Modern, 3 = Creative
            $table->unsignedTinyInteger('selected_template')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};