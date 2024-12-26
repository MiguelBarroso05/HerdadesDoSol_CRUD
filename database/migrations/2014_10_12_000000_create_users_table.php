<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            /*Campos comuns entre clientes e admins*/
            $table->id();
            $table->foreignId('address_id')->nullable()->constrained();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('nif')->unique()->nullable();
            $table->string('password');
            $table->date('birth_date')->nullable();
            $table->string('phone')->nullable(); //??? Decidi meter também no staff (Se preferirem podem deixar so no cliente) ???
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();

            /*Campos únicos de staff*/
            $table->string('username')->nullable(); //??? O que acham de tirar e ficar apenas com primeiro e ultimo nome? ???
            $table->string('img')->nullable();

            /*Campos únicos de cliente*/
            $table->double('balance')->nullable();
            $table->timestamp('email_verified_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
