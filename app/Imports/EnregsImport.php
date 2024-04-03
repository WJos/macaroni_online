<?php


namespace App\Imports;

use App\Models\Enreg;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

// class EnregsImport implements ToModel, WithChunkReading, WithHeadingRow
// {
//     public function model(array $row)
//     {
//         return new Enreg([
//             'num_wagon' => $row['WAGON'],
//             'num_dossier' => $row['N° DOSSIER'],
//             'type' => $row['TYPE'],
//             'num_tc' => $row['N° TC'],
//             'posit_plomb' => $row['POSIT/PLOMB'],
//             'poids' => $row['POIDS'],
//             'destination' => $row['DEST'],
//             //'client' => $row[0],
//         ]);
//     }

//     public function headingRow(): int
//     {
//         return 12;
//     }
    
//     public function chunkSize(): int
//     {
//         return 1000;
//     }
// }

class EnregsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        //dd($rows);
        $counter = 0;
        foreach ($rows as $key  => $value) 
        {
            unset($rows[$key]);
            if ($value[0] == 'WAGON') {
                 break;
            }
        }
        // dd($rows);
        foreach ($rows as $row) 
        {
            try {
                $client_id = $this->findClient($row[7]);
                Enreg::create([
                    'num_wagon' => $row[0],
                    'num_dossier' => $row[1],
                    'type' => $row[2],
                    'num_tc' => $row[3],
                    'posit_plomb' => $row[4],
                    'poids' => $row[5],
                    'destination' => $row[6],
                    'user_id' => $client_id,
                    ]);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
        
    }

    public function findClient($name)
    {
        // $user = User::firstOrCreate(['name' => $name, 'email'  => 'email@email.com', 'password' => Hash::make('password')]);
        $user = User::firstOrCreate(['name' => $name]);
        return $user->id;
    }
}