<?php

namespace App\Enum;

enum RoleGroupeEnum: string 
{
    case CREATEUR = 'Créateur';
    case MEMBRE = 'Membre';
    case SPECTATEUR = 'Spectateur';
}