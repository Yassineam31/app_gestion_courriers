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
        Schema::create('archive_entrants', function (Blueprint $table) {
            $table->id();
            $table->string('Reference')->nullable();
            $table->string('Expediteur');
            $table->string('NumeroInscriptionAcademie')->nullable();
            $table->date('DateInscriptionAcademie')->nullable();
            $table->string('NumeroEnvoiEntiteExpeditrice')->nullable();
            $table->date('DateEnvoiEntiteExpeditrice')->nullable();
            $table->string('CorrespondanceRequiertReponse',4);
            $table->string('Repondu',4)->nullable();
            $table->date('DernierDelaiReponse')->nullable();
            $table->string('SujetCorrespondance',1000);
            $table->string('TelechargementCorrespondance');
            $table->string('Statut')->nullable();
            $table->foreignId('user_id')->constrained()
                ->onUpdate('restrict')
                ->onDelete('restrict');
            /*$table->foreignId('courrier_entrants_id')->constrained('courrier_entrants')
                ->onUpdate('restrict')
                ->onDelete('restrict');*/
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archive_entrants');
    }
};
