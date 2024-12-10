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
        Schema::create('archive_sortants', function (Blueprint $table) {
            $table->id();
            $table->string('Reference')->nullable();
            $table->string('Destinataire');
            $table->string('NumeroEnvoiAcademie')->nullable();
            $table->date('DateEnvoiAcademie')->nullable();
            $table->string('ObjetCorrespondance', 1000);
            $table->string('CorrespondanceRequiertReponse', 10);
            $table->date('DernierDelaiReceptionReponse')->nullable();
            $table->string('ReponseRecue', 10)->nullable();
            $table->string('TelechargementCorrespondance');
            $table->string('Statut', 50)->nullable();
            $table->foreignId('user_id')->constrained()
                ->onUpdate('restrict')
                ->onDelete('restrict');
            /*$table->foreignId('courrier_sortants_id')->constrained('courrier_sortants')
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
        Schema::dropIfExists('archive_sortants');
    }
};
