<div class="toc-container {{ $cssClasses ?? '' }} @if(theme_option('toc_bullet_spacing') == 1) have_bullets @else no_bullets @endif table-of-content">
    <p class="toc_title" data-show-text="{{ trans('plugins/toc::toc.show') }}" data-hide-text="{{ trans('plugins/toc::toc.hide') }}">
        {{ trans('plugins/toc::toc.post_content') }}
        <span class="toc_toggle">
            [<a href="#">{{ trans('plugins/toc::toc.show') }}</a>]
        </span>
    </p>
    <ul class="toc_list">{!! $items !!}</ul>
</div>