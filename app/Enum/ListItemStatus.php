<?php
namespace App\Enum;

enum ListItemStatus: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
}
