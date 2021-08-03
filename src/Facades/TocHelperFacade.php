<?php

namespace Botble\Toc\Facades;

use Botble\Toc\TocHelper;
use Illuminate\Support\Facades\Facade;

class TocHelperFacade extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return TocHelper::class;
    }
}
