<?php

namespace Database\Seeders;

use App\Models\Formula;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $formulas =[
            [
                'formula' => 'TPAFD = 100 \times \frac{TPhd}{TP}',
                'ind_id'=> 16
            ],
            [
                'formula' => 'TPTC = 100 \times \frac{PTC}{TP}',
                'ind_id'=>17
            ],
            [
                'formula' => 'TDG_2 = \frac{1}{n} \sum_{i=1}^{n} \frac{NEG_{(A_i + 2)}}{NEG_{(A_i)}} \times 100',
                'ind_id'=>19
            ],
            [
                'formula' => 'TTG = 100 \left( \frac{1}{n} \sum_{i=1}^{n} \frac{NEGT_i}{TEG_i} \right)',
                'ind_id'=>21
            ],
            [
                'formula' => 'TTP = 100 \left( \frac{1}{n} \sum_{i=1}^{n} \frac{NEPT_i}{TEC_i} \right)',
                'ind_id'=>22
            ],
            [
                'formula' => 'IP = 100 \cdot \frac{TPyRF + TPyCI + TPyCN}{TP}',
                'ind_id'=>25
            ],
            [
                'formula' => 'IP = \frac{PAC + PA + LyCL + PIA}{PTC + 0.5 \cdot PMT}',
                'ind_id'=>26
            ],
            [
                'formula' => 'IPV = \frac{TPV}{TOA}',
                'ind_id'=>29
            ],

        ];

        foreach ($formulas as $formula) {
            Formula::create($formula);
        }

    }
}
