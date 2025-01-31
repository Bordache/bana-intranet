<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Domain;
use App\Models\Objet;

class DomainObjectSeeder extends Seeder
{
    public function run(): void
    {
        $domains = [
            'comm' => ['post', 'user', 'role', 'permission', 'log'],
            'doc'  => ['file', 'user', 'role', 'permission', 'log'],
            'rh'   => ['pers', 'unit', 'rank', 'perm', 'user', 'role', 'permission', 'log'],
            'form' => ['stg', 'pers', 'user', 'role', 'permission', 'log'],
        ];

        foreach ($domains as $domainName => $objects) {
            $domain = Domain::firstOrCreate(['name' => $domainName]);

            foreach ($objects as $objectName) {
                Objet::firstOrCreate(['name' => $objectName, 'domain_id' => $domain->id]);
            }
        }
    }
}
