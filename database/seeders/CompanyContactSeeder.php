<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = storage_path('app/company-contacts.csv');
        $file = fopen($path, 'r');

        fgetcsv($file);

        $data = [];
        $id = 1;
        while (($row = fgetcsv($file)) !== false) {
            $company = Company::where('name', $row[0])->first();
            $contact = Contact::where('name', $row[1])->where('email', $row[2])->where('phone', $row[3])->first();
            if($company && $contact) {
                $data[] = [
                    'id' => $id++,
                    'company_id' => $company->id,
                    'contact_id' => $contact->id,
                ];
            }
        }

        fclose($file);

        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('company_contacts')->insert($chunk);
        }
    }
}
