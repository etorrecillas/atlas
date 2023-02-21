<?php

namespace App\Console\Commands;

use App\Models\MilitaryBranch;
use App\Models\MilitaryOrganization;
use App\Models\Ranking;
use App\Models\Role;
use App\Models\Specialty;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SystemFreshInstallation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:fresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'System Fresh Installation';

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
        $var = $this->call('database:drop');

        $now = Carbon::now('America/Sao_Paulo');

        if($var == 1) {
            $this->call('migrate:fresh');
        }

        $roleList = [
            [
                'title' => 'ADMINISTRADOR',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'USUÁRIO',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('roles')->insert($roleList);

        $permissionList = [
            [
                'title' => 'user_access',
                'description' => 'Permissão para acessar o módulo de usuários',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'mo_access',
                'description' => 'Permissão para acessar o módulo de OM',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'activity_type_access',
                'description' => 'Permissão para acessar o módulo de tipos de atividades',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'activity_access',
                'description' => 'Permissão para acessar o módulo de atividades',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'report_upload',
                'description' => 'Permissão para acessar o módulo de criação de relatórios',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'report_access',
                'description' => 'Permissão para acessar o módulo de relatórios',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'log_access',
                'description' => 'Permissão para acessar o módulo de logs',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];

        DB::table('permissions')->insert($permissionList);

        $rolePermissionList = [
            [
                'role_id' => 1,
                'permission_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 2,
            ],
            [
                'role_id' => 1,
                'permission_id' => 3,
            ],
            [
                'role_id' => 1,
                'permission_id' => 4,
            ],
            [
                'role_id' => 1,
                'permission_id' => 5,
            ],
            [
                'role_id' => 1,
                'permission_id' => 6,
            ],
            [
                'role_id' => 1,
                'permission_id' => 7,
            ],
            [
                'role_id' => 2,
                'permission_id' => 4,
            ],
            [
                'role_id' => 2,
                'permission_id' => 6,
            ],
        ];

        DB::table('permission_role')->insert($rolePermissionList);

        $rankingList = [
            [
                'title' => 'Tenente-Brigadeiro do Ar',
                'short' => 'TB',
                'sorting' => 10,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Major-Brigadeiro',
                'short' => 'MB',
                'sorting' => 20,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Brigadeiro',
                'short' => 'BR',
                'sorting' => 30,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Coronel',
                'short' => 'CL',
                'sorting' => 40,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Tenente-Coronel',
                'short' => 'TC',
                'sorting' => 50,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Major',
                'short' => 'MJ',
                'sorting' => 60,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Capitão',
                'short' => 'CP',
                'sorting' => 70,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Primeiro-Tenente',
                'short' => '1T',
                'sorting' => 80,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Segundo-Tenente',
                'short' => '2T',
                'sorting' => 90,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Aspirante',
                'short' => 'AP',
                'sorting' => 100,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Suboficial',
                'short' => 'SO',
                'sorting' => 110,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Primeiro-Sargento',
                'short' => '1S',
                'sorting' => 120,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Segundo-Sargento',
                'short' => '2S',
                'sorting' => 130,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Terceiro-Sargento',
                'short' => '3S',
                'sorting' => 140,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Cabo',
                'short' => 'CB',
                'sorting' => 150,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Soldado Primeira Classe',
                'short' => 'S1',
                'sorting' => 160,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Soldado Segunda Classe',
                'short' => 'S2',
                'sorting' => 170,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Civil',
                'short' => 'CV',
                'sorting' => 180,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('rankings')->insert($rankingList);

        $branchesList = [
            [
                'title' => 'Quadro de Oficiais Aviadores',
                'short' => 'QOAV',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro de Oficiais de Infantaria',
                'short' => 'QOINF',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro de Oficiais Intendentes',
                'short' => 'QOINT',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro de Oficiais Médicos',
                'short' => 'QOMED',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro de Oficiais Engenheiros',
                'short' => 'QOENG',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro de Oficiais Dentistas',
                'short' => 'QODENT',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro de Oficiais Farmacêuticos',
                'short' => 'QOFARM',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro de Oficiais Capelães',
                'short' => 'QOCAPL',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro de Oficiais Especialistas em Aeronaes',
                'short' => 'QOEANV',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro de Oficiais Especialistas em Armamento',
                'short' => 'QOEARM',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro de Oficiais Especialistas em Comunicações',
                'short' => 'QOECOM',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro de Oficiais Especialistas em Controle de Tráfego Aéreo',
                'short' => 'QOECTA',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro de Oficiais Especialistas em Foto-Interpretação',
                'short' => 'QOEFI',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro de Oficiais Especialistas em Meteorologia',
                'short' => 'QOEMET',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro de Oficiais Especialistas em Suprimento Técnico',
                'short' => 'QOEST',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro de Oficiais de Apoio',
                'short' => 'QOAP',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro de Oficiais Técnicos',
                'short' => 'QOTEC',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro de Oficiais Convocados da Reserva',
                'short' => 'QOCON',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro Complementar de Oficiais',
                'short' => 'QCOA',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro de Suboficiais e Sargentos',
                'short' => 'QSS',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro Especial de Sargentos',
                'short' => 'QESA',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro de Cabos',
                'short' => 'QCB',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro de Taifeiros',
                'short' => 'QTA',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro de Soldados',
                'short' => 'QSD',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro de Oficiais da Reserva Remunerada',
                'short' => 'QORR',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Quadro de Praças da Reserva Remunerada',
                'short' => 'QPRR',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Não Aplicável',
                'short' => 'N/A',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('military_branches')->insert($branchesList);

        $specialtiesList = [
            [
                'title' => 'Infraestrutura',
                'short' => 'IES',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Civil',
                'short' => 'CIV',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Sem Especialidade',
                'short' => 'S/E',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];

        DB::table('specialties')->insert($specialtiesList);

        $militaryOrganization = [
            'title' => 'Diretoria de Infraestrutura da Aeronáutica',
            'short' => 'DIRINFRA',
            'created_at' => $now,
            'updated_at' => $now,
        ];

        DB::table('military_organizations')->insert($militaryOrganization);

        $admin = [
            'name' => 'JANINE',
            'ranking_id' => Ranking::where('short', 'TC')->first()->id,
            'military_branch_id' => MilitaryBranch::where('short', 'QOENG')->first()->id,
            'specialty_id' => Specialty::where('short', 'IES')->first()->id,
            'military_organization_id' => MilitaryOrganization::where('short', 'DIRINFRA')->first()->id,
            'email' => 'janinejld@fab.mil.br',
            'password' => Hash::make('abcd1234'),
            'created_at' => $now,
            'updated_at' => $now,
        ];

        DB::table('users')->insert($admin);

        DB::table('role_user')->insert([
            'role_id' => Role::where('title', 'ADMINISTRADOR')->first()->id,
            'user_id' => User::where('email', 'janinejld@fab.mil.br')->first()->id,
        ]);


        return 0;
    }
}
