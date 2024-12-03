<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArchiveSortant>
 */
class ArchiveSortantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('ar_SA');
        return [
            'Reference'=>$faker->unique()->regexify('[0-9]X[0-9]{3}'),
            'Destinataire' => $faker->name,
            'NumeroEnvoiAcademie' => $faker->regexify('[A-Z]{3}[0-9]{3}'),
            'DateEnvoiAcademie' => $faker->date(),
            'ObjetCorrespondance' => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'CorrespondanceRequiertReponse' => $faker->randomElement(['نعم', 'لا']),
            'DernierDelaiReceptionReponse' => $faker->dateTimeBetween('now', '+1 year'),
            'ReponseRecue' => $faker->randomElement(['نعم', 'لا']),
            'TelechargementCorrespondance' => $faker->url,
            'Statut' => $faker->randomElement(['قيد المعالجة', 'في الإنتظار', 'مكتمل']),
            'user_id' => rand(1,30),
            'courrier_sortants_id' => rand(1,30)
        ];
    }
}
