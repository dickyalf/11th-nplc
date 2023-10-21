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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('invoice_number');
            $table->foreignId('payment_method_id')->nullable()->constrained('payment_methods')->onDelete('cascade');
            $table->enum('payment_status', [0, 1, 2])
                ->default(0)
                ->comment('0: Pending, 1: Success, 2: Failed');
            $table->dateTime('payment_due_date');
            $table->string('payment_reference')->nullable();
            $table->string('delivery_address');
            $table->enum('delivery_status', [0, 1, 2, 3])
                ->default(0)
                ->comment('0: Waiting, 1: On Delivery, 2: Delivered, 3: Failed');
            $table->string("delivery_courier")->nullable();
            $table->integer('price')->default(0);
            $table->integer('delivery_fee')->default(0);
            $table->string('resi_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
