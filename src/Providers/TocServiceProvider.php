<?php

namespace Botble\Toc\Providers;

use Botble\Base\Supports\Helper;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Toc\Facades\TocHelperFacade;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class TocServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');

        AliasLoader::getInstance()->alias('TocHelper', TocHelperFacade::class);
    }

    public function boot()
    {
        $this->setNamespace('plugins/toc')
            ->loadAndPublishConfigurations(['general'])
            ->loadAndPublishTranslations()
            ->publishAssets()
            ->loadAndPublishViews();

        $this->app->register(HookServiceProvider::class);
    }
}
