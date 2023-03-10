<div id="kt_app_toolbar" class="app-toolbar pt-3">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                {{head($routes)}}
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{route("admin.dashboard.index")}}" class="text-muted text-hover-primary">{{__("Home")}}</a>
                </li>
                @foreach($routes as $route => $title)
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{$route}}" class="text-muted text-hover-primary">{{$title}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
