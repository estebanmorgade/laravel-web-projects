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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url')->unique();
            $table->timestamps();
        });

        Schema::table('projects', function(Blueprint $table){
            $table->unsignedBigInteger('category_id')->nullable()->after('id');

            $table->foreign('category_id')->references('id')->on('categories')
            ->onUpdate('cascade')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function(Blueprint $table){
            $table->dropForeign('projects_category_id_foreign');
            $table->dropColumn('category_id');
        });

        Schema::dropIfExists('categories');
    }
};
