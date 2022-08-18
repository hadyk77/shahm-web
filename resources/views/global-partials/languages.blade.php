<div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
    <a href="javascript:;" class="menu-link px-5">
        <span class="menu-title position-relative">{{__("Language")}}
            <span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">
                <img class="w-15px h-15px rounded-1 ms-2" src="{{asset(LaravelLocalization::getLocalesOrder()[LaravelLocalization::getCurrentLocale()]['flag'])}}" alt=""/>
                {{LaravelLocalization::getCurrentLocaleNative()}}
            </span>
        </span>
    </a>
    <div class="menu-sub menu-sub-dropdown w-175px py-4">
        <div class="menu-item px-3">
            @foreach(LaravelLocalization::getLocalesOrder() as $locale => $language)
                <a href="{{LaravelLocalization::getLocalizedURL($locale)}}" class="menu-link d-flex px-5 {{LaravelLocalization::getCurrentLocale() == $locale ? "active" : ""}}">
                    <span class="symbol symbol-20px me-4">
                        <img class="rounded-1" src="{{asset($language["flag"])}}" alt=""/>
                    </span>
                    {{$language["native"]}}
                </a>
            @endforeach
        </div>
    </div>
</div>
