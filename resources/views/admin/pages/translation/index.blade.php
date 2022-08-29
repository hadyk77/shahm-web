@extends("admin.layouts.app")

@section("content")
    <div class="row">
        <div class="col-md-3">
            <x-card-content>
                <x-card-header class="py-0">
                    <x-card-toolbar>
                        <button type="button" class="open_all btn btn-success mx-3 btn-sm">{{__("Open all")}}</button>
                        <button type="button" class="close_all btn btn-danger btn-sm">{{__("Close all")}}</button>
                    </x-card-toolbar>
                </x-card-header>
                <x-card-body>
                    <div id="jstree">
                        <ul>
                            @foreach($translatable as $key => $value)
                                <li>
                                    {{$key}}
                                    <ul>
                                        @foreach(app($value["model"])->get() as $single_record)
                                            <li class="word"
                                                data-model="{{$value["model"]}}"
                                                data-id="{{$single_record->id}}"
                                                data-columns="{{json_encode($value["columns"])}}"
                                                id="{{\Illuminate\Support\Str::lower(\Str::replace("\\", "_", $value["model"])) . "_" . $single_record->id}}"
                                            >{{$single_record->getTranslation($value["translatableColumn"], 'ar')}}
                                                @if(isset($value['relations']))
                                                    @foreach($value['relations'] as $single_relation)
                                                        <ul>
                                                            @foreach($single_record->{$single_relation['relationName']} as $single_relation_record)
                                                                <li
                                                                    class="relation_word word"
                                                                    data-model="{{$single_relation["model"]}}"
                                                                    data-id="{{$single_relation_record->id}}"
                                                                    data-columns="{{json_encode($single_relation["columns"])}}"
                                                                    id="{{\Illuminate\Support\Str::lower(\Str::replace("\\", "_", $single_relation["model"])) . "_" . $single_relation_record->id}}"
                                                                >
                                                                    {{$single_relation_record->getTranslation($value["translatableColumn"], 'ar')}}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endforeach
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </x-card-body>
            </x-card-content>
        </div>
        <div class="col-md-9">
            <x-card-content>
                <x-card-body id="translation_data">
                    <h1 class="text-center">{{__("Please choose what you want to translate")}}</h1>
                </x-card-body>
            </x-card-content>
        </div>
    </div>
@endsection


@section("styles")
    <link href="{{asset("admin/plugins/custom/jstree/jstree.bundle.css")}}" rel="stylesheet" type="text/css"/>
@endsection

@section("scripts")
    <script src="{{asset("admin/plugins/custom/jstree/jstree.bundle.js")}}"></script>
    <script>
        $(function () {
            $('#jstree').jstree();
            $(document).on('click', '.word', function () {
                let model = $(this).attr('data-model');
                let id = $(this).attr('data-id');
                let columns = JSON.parse($(this).attr('data-columns'));
                $.ajax({
                    url: "{{route('admin.translation.show')}}",
                    method: "POST",
                    data: {
                        model,
                        id,
                        columns,
                        _token: "{{csrf_token()}}"
                    },
                    beforeSend: function () {

                    },
                    success: function (response) {
                        $('#translation_data').html(response);
                        $('html, body').animate({scrollTop: 0}, 'smooth');
                    }
                });
            });

            $(document).on('click', '.word', function (e) {

                if ($(this).hasClass("relation_word")) {
                    e.stopPropagation();
                }

            });

            $(document).on('submit', "#translation_data form", function (event) {
                event.preventDefault();
                $.ajax({
                    url: $(this).data('action'),
                    method: "POST",
                    data: $(this).serialize(),
                    beforeSend: function () {

                    },
                    success: function (response) {
                        if (response.success) {
                            toastr.success(response.message);
                            let clickedNode = $('.jstree-clicked')
                            let html = '<i class="jstree-icon jstree-themeicon" role="presentation"></i>';
                            html += response.data.title;
                            clickedNode.html(html);
                        }
                    }
                });
            });
            $('.open_all').on('click', function () {
                $("#jstree").jstree("open_all");
            })
            $('.close_all').on('click', function () {
                $("#jstree").jstree("close_all");
            })
        });
    </script>
@endsection
