<?php

return new class
{
    /**
     * Create the migrations
     */
    public function up(): void
    {
        Schema::create('users2', function (Table $table) {
            $table->id();
            $table->integer('edad');
            $table->string('nombre',255)->unique()->nullable();
            $table->string('apellido');
            $table->integer('codigo');
            $table->decimal('salario',5,2);
            $table->timestamp('creado_en');
            //$table->rememberToken();
        });

        // Schema::create('sessions', function (Table $table) {
        //     $table->string('id')->primary();
        //     $table->foreignId('user_id')->nullable()->index();
        //     $table->string('ip_address', 45)->nullable();
        //     $table->text('user_agent')->nullable();
        //     $table->longText('payload');
        //     $table->integer('last_activity')->index();
        // });

    }

    /**
     * Delete the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users2');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
