<?php

namespace Botble\Toc\Providers;

use Botble\Base\Models\BaseModel;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use MetaBox;
use Theme;
use TocHelper;

class HookServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (function_exists('shortcode')) {
            add_shortcode('toc', trans('plugins/toc::toc.toc_shortcode'),
                trans('plugins/toc::toc.toc_short_code_description'), [$this, 'tocShortcode']);

             add_shortcode('no-toc', trans('plugins/toc::toc.no_toc_shortcode'),
                trans('plugins/toc::toc.no_toc_short_code_description'), [$this, 'noTocShortcode']);

            shortcode()
                    ->setAdminConfig('toc', view('plugins/toc::partials.short-code-toc-admin-config')->render());
            shortcode()
                    ->setAdminConfig('no-toc', view('plugins/toc::partials.short-code-no-toc-admin-config')->render());
        }

        if (function_exists('theme_option')) {
            add_action(RENDERING_THEME_OPTIONS_PAGE, [$this, 'addThemeOptions'], 35);
        }

        add_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, [$this, 'addToCContent'], 56, 2);
    }

    /**
     * @param string $screen
     * @param BaseModel $object
     */
    public function addToCContent($screen, $object)
    {
        if ($object) {
            $showToC = theme_option('toc_enable') ?: config('plugins.toc.general.default_option_in_form');

            if ($showToC == 1) {
                Theme::asset()
                    ->usePath(false)
                    ->add('toc-css', 'vendor/core/plugins/toc/css/toc.css');

                Theme::asset()
                    ->container('footer')
                    ->usePath(false)
                    ->add('toc-js', 'vendor/core/plugins/toc/js/toc.js', ['jquery']);

                $object->content = TocHelper::theContentShortcode($object->content, $object);
            }
        }
    }

    public function addThemeOptions()
    {
        theme_option()
            ->setSection([
                'title'      => 'Table of content Plus',
                'desc'       => 'Table of content',
                'id'         => 'opt-text-subsection-toc',
                'subsection' => true,
                'icon'       => 'fa fa-edit',
                'fields'     => [
                    [
                        'id'         => 'toc_enable',
                        'type'       => 'onOff',
                        'label'      => trans('plugins/toc::toc.toc_enable'),
                        'attributes' => [
                            'name'    => 'toc_enable',
                            'value' => 0,
                            'data' => [
                                0 => 'No',
                                1 => 'Yes',
                            ],
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'id'         => 'toc_position',
                        'type'       => 'select',
                        'label'      => trans('plugins/toc::toc.toc_position'),
                        'attributes' => [
                            'name'    => 'toc_position',
                            'data'    => [
                                'before-first-heading' => trans('plugins/toc::toc.before_first_heading'),
                                'after-first-heading'  => trans('plugins/toc::toc.after_first_heading'),
                                'top'                  => trans('plugins/toc::toc.top'),
                                'bottom'               => trans('plugins/toc::toc.bottom'),
                            ],
                            'value'   => null,
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'id'         => 'toc_show_when',
                        'type'       => 'select',
                        'label'      => trans('plugins/toc::toc.toc_show_when'),
                        'attributes' => [
                            'name'    => 'toc_show_when',
                            'list'    => [2, 3, 4, 5, 6],
                            'value'   => '',
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'id'         => 'toc_show_hierarchy',
                        'type'       => 'onOff',
                        'label'      => trans('plugins/toc::toc.toc_show_hierarchy'),
                        'attributes' => [
                            'name'    => 'toc_show_hierarchy',
                            'value' => 1,
                            'data' => [
                                0 => 'No',
                                1 => 'Yes',
                            ],
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'id'         => 'toc_number_list_item',
                        'type'       => 'onOff',
                        'label'      => trans('plugins/toc::toc.toc_number_list_item'),
                        'attributes' => [
                            'name'    => 'toc_number_list_item',
                            'value' => 0,
                            'data' => [
                                0 => 'No',
                                1 => 'Yes',
                            ],
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'id'         => 'toc_number_smooth_scroll',
                        'type'       => 'onOff',
                        'label'      => trans('plugins/toc::toc.toc_number_smooth_scroll'),
                        'attributes' => [
                            'name'    => 'toc_number_smooth_scroll',
                            'value' => 0,
                            'data' => [
                                0 => 'No',
                                1 => 'Yes',
                            ],
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'id'         => 'toc_hyphenate',
                        'type'       => 'text',
                        'label'      => trans('plugins/toc::toc.toc_hyphenate'),
                        'attributes' => [
                            'name'    => 'toc_hyphenate',
                            'value'   => null,
                            'options' => [
                                'class'        => 'form-control',
                            ],
                        ],
                    ],
                    [
                        'id'         => 'appearance_exclude_headings',
                        'type'       => 'text',
                        'label'      => trans('plugins/toc::toc.toc_appearance_exclude_headings'),
                        'attributes' => [
                            'name'    => 'appearance_exclude_headings',
                            'value'   => null,
                            'options' => [
                                'class'        => 'form-control',
                            ],
                        ],
                    ]
                ],
            ]);
    }

    public function tocShortcode()
    {
        return '<!--TOC-->';
    }

    public function noTocShortcode()
    {
        return '<!--No-TOC-->';
    }
}
