<?php

namespace App\Facades;

use App\Service\AdminPanelService;
use Illuminate\Support\Facades\Facade;

/**
 * @see AdminPanelService
 * @method static getEventRating()
 * @method static childRatingStats()
 * @method static staff()
 */
class AdminPanel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'AdminPanel';
    }
}
