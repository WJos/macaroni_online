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
        Schema::create('enregs', function (Blueprint $table) {
            $table->bigIncrements('enreg_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('num_wagon');
            $table->string('num_dossier');
            $table->string('type');
            $table->string('num_tc');
            $table->string('posit_plomb');
            $table->string('poids');
            $table->string('destination');
            $table->string('train')->nullable();
            $table->string('position_actu')->nullable();

            $table->date('date_entree')->nullable();
            $table->date('date_sortie')->nullable();
            $table->string('consignataire')->nullable();
            $table->string('destinataire')->nullable();
            $table->string('type_marchandise')->nullable();
            $table->string('num_facture')->nullable();
            $table->decimal('montant_facture',12,2)->nullable();
            $table->string('percepteur')->nullable();
            $table->string('num_declaration')->nullable();
            $table->string('num_bon')->nullable();
            $table->string('chauffeur')->nullable();
            $table->string('num_chauffeur')->nullable();
            $table->string('num_camion')->nullable();
            $table->boolean('online')->default(1);
            $table->boolean('offline')->default(0);
            $table->string('statut')->default('N');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enregs');
    }
};
