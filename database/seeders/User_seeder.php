<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\System\Company;
use App\Models\System\Company_permission;

class User_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = ['company' => 'AlgosLab', 'first_name' => 'System', 'last_name' => 'Admin', 'phone' => '1629393179', 'email' => 'com.algoslab@gmail.com', 'status' => 1, 'note' => 'Company Seeder', 'address' => 'Ghatail Tangail'];
        $items = [
            [
                'first_name' => 'System', 'last_name' => 'Admin', 'email' => 'com.algoslab@gmail.com', 
                'phone' => '1629393179', 'employee_no' => 'aaa123', 'company_id' => 1, 
                'password' => bcrypt('password'), 'status' => 1, 'is_consultant' => 1,
                'role_id' => 1, 'salary' => 0.00, 'is_owner' => 1
            ]
        ];
        $company_permission = ['module_id' => 1, 'sub_module_id' => 6, 'status' => 1, 'company_id' => 1];
        DB::beginTransaction();
        try{
            Company::create($company);
            foreach ($items as $item) {
                User::create($item);
            }
            Company_permission::create($company_permission);
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        
    }
}
