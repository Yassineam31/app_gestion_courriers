<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourrierEntrant>
 */
class CourrierEntrantFactory extends Factory
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
            'Expediteur' => $faker->company,
            'NumeroInscriptionAcademie' => $faker->regexify('[A-Z]{3}[0-9]{3}'),
            'DateInscriptionAcademie' => $faker->date(),
            'NumeroEnvoiEntiteExpeditrice' => $faker->regexify('[A-Z]{2}[0-9]{4}'),
            'DateEnvoiEntiteExpeditrice' => $faker->date(),
            'CorrespondanceRequiertReponse' => $faker->randomElement(['نعم', 'لا']),
            'Repondu' => $faker->randomElement(['نعم', 'لا']),
            'DernierDelaiReponse' => $faker->dateTimeBetween('now', '+1 year'),
            'SujetCorrespondance' => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'TelechargementCorrespondance' => $faker->url,
            'Statut' => $faker->randomElement(['قيد المعالجة', 'في الإنتظار', 'مكتمل']),
            'user_id' => rand(1,30)
            
        ];
    }
}
