<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateInOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate_in_order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute the migrations in the order specified in the file app/Console/Comands/MigrateInOrder.php \n Drop all the table in db before execute the command.';

     /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
       /** Specify the names of the migrations files in the order you want to
        * loaded
        * $migrations =[
        *               'xxxx_xx_xx_000000_create_nameTable_table.php',
        *    ];
        */
        $migrations = [
                        '1_create_sensors_table.php',
                        '2_create_vizfogyasztas_table.php',
                        '3_create_uzems_table.php',
                        '4_create_elszivos_table.php',
                        '5_create_termelogeps_table.php',
                        '6_create_kompresszors_table.php',
                        '7_create_sensor_data_table.php',
                        '8_create_failed_jobs_table.php',
                        '9_create_personal_access_tokens_table.php',
                        '10_create_trigger.php',

        ];
                        //'11_create_trigger2.php'
        foreach($migrations as $migration)
        {
           $basePath = 'database/migrations/';
           $migrationName = trim($migration);
           $path = $basePath.$migrationName;
           $this->call('migrate:refresh', [
            '--path' => $path ,
           ]);
        }
    }
}
