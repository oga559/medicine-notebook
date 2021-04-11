<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Medical_factory;
use Faker\Provider\Medical;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = new Medical_factory([
           'factory_name' => '東北公済病院'
          ]);
            $employee->save();
        
          // 2レコード
          $employee = new Medical_factory([
            'factory_name' => '東北病院'
          ]);
          $employee->save();
        
          // 3レコード
          $employee = new Medical_factory([
            'factory_name' => '東北大学病院'
          ]);
          $employee->save();
          $employee = new Medical_factory([
            'factory_name' => '仙台大学病院'
          ]);
          $employee->save();
          $employee = new Medical_factory([
            'factory_name' => '東北労災病院'
          ]);
          $employee->save();
          $employee = new Medical_factory([
            'factory_name' => '公益財団法人仙台市医療センター仙台オープン病院'
          ]);
          $employee->save();
          $employee = new Medical_factory([
            'factory_name' => 'ＪＲ仙台病院'
          ]);
          $employee->save();
          $employee = new Medical_factory([
            'factory_name' => '仙台クリニック'
          ]);
          $employee->save();
          $employee = new Medical_factory([
            'factory_name' => '中嶋病院'
          ]);
          $employee->save();
          $employee = new Medical_factory([
            'factory_name' => '栗原市立栗原中央病院'
          ]);
          $employee->save();
          $employee = new Medical_factory([
            'factory_name' => '石巻赤十字病院'
          ]);
          $employee->save();
          $employee->save();
          $employee = new Medical_factory([
            'factory_name' => '財団法人宮城県成人病予防協会附属仙台循環器病センター'
          ]);
          $employee->save();
          $employee = new Medical_factory([
            'factory_name' => '宮城県立がんセンター'
          ]);
          $employee->save();
          $employee = new Medical_factory([
            'factory_name' => 'みやぎ県南中核病院'
          ]);
          $employee->save();
        }
}

