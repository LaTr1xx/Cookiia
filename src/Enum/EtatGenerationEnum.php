<?php

namespace App\Enum;

enum EtatGenerationEnum: string 
{
    case MANUELLE = 'Manuelle';
    case AUTOMATIQUE = 'Automatique';
}