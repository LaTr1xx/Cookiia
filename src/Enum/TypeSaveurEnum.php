<?php

namespace App\Enum;

enum TypeSaveurEnum: string 
{
    case SALE = 'Salé';
    case SUCRE = 'Sucré';
    case SUCRE_SALE = 'Sucré-salé';
    case EPICE = 'Epicé';
}