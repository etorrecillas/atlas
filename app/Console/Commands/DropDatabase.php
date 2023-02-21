<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DropDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:drop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop all database tables and data. Use with caution';

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
     *
     * @return int
     */
    public function handle()
    {
        if (!$this->confirm('Todos dados serão apagados. Confirma nova instalação do sistema? [y|N]')) {
            exit('Instalação cancelada.');
        }

        $colname = 'Tables_in_' . env('DB_DATABASE');

        $tables = DB::select('SHOW TABLES');

        foreach($tables as $table) {

            $droplist[] = $table->$colname;

        }

        if(isset($droplist)) {

            $droplist = implode(',', $droplist);

            DB::beginTransaction();
            //turn off referential integrity
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            DB::statement("DROP TABLE $droplist");
            //turn referential integrity back on
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');
            DB::commit();

        }

        $this->comment(PHP_EOL."Banco de dados apagado com sucesso.".PHP_EOL);

        return 1;
    }
}
