<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\User;

class IntegrityService {

    public function integrityData()
    {
        $usersWithoutOm = User::whereNull('military_organization_id')
            ->orderBy('name')
            ->get();

        $activitiesWithoutOm = Activity::whereNull('military_organization_id')
            ->orderBy('title')
            ->get();

        $activitiesWithoutType = Activity::whereNull('activity_type_id')
            ->orderBy('title')
            ->get();

        $activitiesWithoutSector = Activity::whereNull('sector')
            ->orderBy('title')
            ->get();

        $viewClasses = [
            $usersWithoutOm->count() > 0 ? 'danger' : 'success',
            $activitiesWithoutOm->count() > 0 ? 'danger' : 'success',
            $activitiesWithoutType->count() > 0 ? 'danger' : 'success',
            $activitiesWithoutSector->count() > 0 ? 'danger' : 'success',
        ];

        $footerText = [
            $usersWithoutOm->count() > 0 ? 'corrigir' : 'nenhuma ação pendente',
            $activitiesWithoutOm->count() > 0 ? 'corrigir' : 'nenhuma ação pendente',
            $activitiesWithoutType->count() > 0 ? 'corrigir' : 'nenhuma ação pendente',
            $activitiesWithoutSector->count() > 0 ? 'corrigir' : 'nenhuma ação pendente',
        ];

        $footerIcon = [
            $usersWithoutOm->count() > 0 ? 'warning' : 'thumb_up',
            $activitiesWithoutOm->count() > 0 ? 'warning' : 'thumb_up',
            $activitiesWithoutType->count() > 0 ? 'warning' : 'thumb_up',
            $activitiesWithoutSector->count() > 0 ? 'warning' : 'thumb_up',
        ];

        return [
            [
                'title' => 'usuário(s) sem OM',
                'count' => $usersWithoutOm->count(),
                'viewClass' => $viewClasses[0],
                'data' => $usersWithoutOm,
                'adjustmentRoute' => 'admin.usuarios.index',
                'icon' => 'group',
                'footerText' => $footerText[0],
                'footerIcon' => $footerIcon[0],
            ],
            [
                'title' => 'atividade(s) sem OM',
                'count' => $activitiesWithoutOm->count(),
                'viewClass' => $viewClasses[1],
                'data' => $activitiesWithoutOm,
                'adjustmentRoute' => 'atividades.index',
                'icon' => 'local_police',
                'footerText' => $footerText[1],
                'footerIcon' => $footerIcon[1],
            ],
            [
                'title' => 'atividade(s) sem tipo',
                'count' => $activitiesWithoutType->count(),
                'viewClass' => $viewClasses[2],
                'data' => $activitiesWithoutType,
                'adjustmentRoute' => 'atividades.index',
                'icon' => 'format_list_bulleted',
                'footerText' => $footerText[2],
                'footerIcon' => $footerIcon[2],
            ],
            [
                'title' => 'atividade(s) sem subdiretoria',
                'count' => $activitiesWithoutSector->count(),
                'viewClass' => $viewClasses[3],
                'data' => $activitiesWithoutType,
                'adjustmentRoute' => 'atividades.index',
                'icon' => 'format_list_bulleted',
                'footerText' => $footerText[3],
                'footerIcon' => $footerIcon[3],
            ],
        ];

    }
}
