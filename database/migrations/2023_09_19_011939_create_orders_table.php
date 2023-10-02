<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("userId");
            $table->unsignedBigInteger("categoryId");
            $table->unsignedBigInteger("subCategoryId");
            $table->foreign("userId")->references("id")->on("users");
            $table->foreign("categoryId")->references("id")->on("categories");
            $table->foreign("subCategoryId")->references("id")->on("subcategories");
            $table->string('namaBarang');
            $table->date('date');
            $table->enum("statusRequest", ["Accept", "Reject", "Pending"])->default("Pending");
            $table->enum("statusOrder", ["Requested", "On Progress", "Done"])->default("Requested");
            $table->integer("amount");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
