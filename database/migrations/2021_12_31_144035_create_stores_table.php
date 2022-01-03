<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('business_name')->nullable();
            $table->string('head_office_address')->nullable();
            $table->integer('phone_number')->nullable();
            $table->string('website_address')->nullable();
            $table->string('company_status')->nullable();
            $table->string('contact_information')->nullable();
            $table->dateTime('date_of_create')->nullable();
            $table->string('main_activity')->nullable();
            $table->string('main_product')->nullable();
            $table->string('main_service')->nullable();
            $table->string('principal_customer')->nullable();
            $table->string('business_organization')->nullable();
            $table->string('number_of_employee')->nullable();
            $table->string('financial_circumstance')->nullable();
            $table->string('company_capacity')->nullable();
            $table->string('reference')->nullable();
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
        Schema::dropIfExists('stores');
    }
}
