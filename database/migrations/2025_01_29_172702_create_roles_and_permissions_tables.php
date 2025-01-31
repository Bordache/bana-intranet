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
        // Création des rôles
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Création des permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Création des domaines
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Création des objets liés aux domaines
        Schema::create('objects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('domain_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Table pivot : rôle - permissions - domaine - objet
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->foreignId('permission_id')->constrained()->onDelete('cascade');
            $table->foreignId('domain_id')->constrained()->onDelete('cascade');
            $table->foreignId('object_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['role_id', 'permission_id', 'domain_id', 'object_id'], 'role_permission_unique');
        });

        // Table pivot : utilisateur - rôle - domaine - objet
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->foreignId('domain_id')->constrained()->onDelete('cascade');
            $table->foreignId('object_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();

            // Contrainte unique avec prise en charge de `NULL` pour object_id
            $table->unique(['user_id', 'domain_id', 'role_id', 'object_id'], 'user_role_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('role_permissions');
        Schema::dropIfExists('objects');
        Schema::dropIfExists('domains');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
    }
};
