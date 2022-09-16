@extends("admin.layouts.app")

@section("content")
    <x-card-content>
        <x-card-header>
            <x-card-title>
                {{__("Verification File From")}} [{{$file->user->name}}]
            </x-card-title>
            <x-card-toolbar>
                <x-back-btn :route="route('admin.verification-files.index')"/>
            </x-card-toolbar>
        </x-card-header>
        <x-card-body>
            <table class="table table-striped table-bordered">
                <tr>
                    <td>{{__("Captain Name")}}</td>
                    <td>{{$file->user->name}}</td>
                </tr>
                <tr>
                    <td>{{__("File Name")}}</td>
                    <td>{{$file->option->title}}</td>
                </tr>
                <tr>
                    <td>{{__("File")}}</td>
                    <td>
                        <img
                            src="{{$file->getFirstMediaUrl(\App\Enums\CaptainEnum::VERIFICATION_FILE)}}"
                            class="img-fluid d-block"
                            style="width: 200px;"
                            alt=""
                        >
                        <a class="btn btn-success mt-4" download="" href="{{$file->getFirstMediaUrl(\App\Enums\CaptainEnum::VERIFICATION_FILE)}}">{{__("Download")}}</a>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </x-card-body>
    </x-card-content>
    <x-card-content>
        <x-card-body>

            <h1 class="text-center mb-5">
                @if($file->status == 0)
                    <span style="color: red">
                        {{__("File is under revision or rejected")}}
                    </span>
                @else
                    <span style="color: green">
                        {{__("File is accepted")}}
                    </span>
                @endif
            </h1>

            <div class="d-flex justify-content-center">
                <form action="{{route('admin.verification-files.update', [$file->id, "status" => "accepted"])}}" method="post">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-success me-2">{{__("Accept File")}}</button>
                </form>

                <form action="{{route('admin.verification-files.update', [$file->id, "status" => "rejected"])}}" method="post">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-danger">{{__("Rejected File")}}</button>
                </form>
            </div>
        </x-card-body>
    </x-card-content>
@endsection

