<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToEventsTable extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('type');

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');

            // Caso queira remover a coluna antiga:
            $table->dropColumn('category');
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('category', 50)->nullable()->after('type');

            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
}
