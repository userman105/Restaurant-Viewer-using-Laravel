<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->integer('CustomerID')->primary();
            $table->string('CustomerFName', 30);
            $table->string('CustomerLName', 30);
            $table->string('PhoneNo', 11)->unique()->nullable();
            $table->string('Address', 50)->nullable();
            $table->string('Email', 30)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
