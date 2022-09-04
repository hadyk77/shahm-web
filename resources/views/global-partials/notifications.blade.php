@if($notifications->count() > 0)
    @foreach($notifications as $single_notification)
        <div class="d-flex flex-stack py-4 mx-4">
            <div class="d-flex align-items-center">
                <div class="symbol symbol-35px me-4">
                <span class="symbol-label bg-light-success">
                    <span class="svg-icon svg-icon-2 svg-icon-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M5 15C3.3 15 2 13.7 2 12C2 10.3 3.3 9 5 9H5.10001C5.00001 8.7 5 8.3 5 8C5 5.2 7.2 3 10 3C11.9 3 13.5 4 14.3 5.5C14.8 5.2 15.4 5 16 5C17.7 5 19 6.3 19 8C19 8.4 18.9 8.7 18.8 9C18.9 9 18.9 9 19 9C20.7 9 22 10.3 22 12C22 13.7 20.7 15 19 15H5ZM5 12.6H13L9.7 9.29999C9.3 8.89999 8.7 8.89999 8.3 9.29999L5 12.6Z" fill="black"></path>
                            <path d="M17 17.4V12C17 11.4 16.6 11 16 11C15.4 11 15 11.4 15 12V17.4H17Z" fill="black"></path>
                            <path opacity="0.3" d="M12 17.4H20L16.7 20.7C16.3 21.1 15.7 21.1 15.3 20.7L12 17.4Z" fill="black"></path>
                            <path d="M8 12.6V18C8 18.6 8.4 19 9 19C9.6 19 10 18.6 10 18V12.6H8Z" fill="black"></path>
                        </svg>
                    </span>
                </span>
                </div>
                <div class="mb-0 me-2">
                    <a href="javascript:;" data-action="{{route("admin.notification.update", $single_notification->id)}}" class="fs-6 text-gray-800 text-hover-primary {{$single_notification->unread() ? "notification_record fw-bolder" : ""}}">
                        {{App\Enums\NotificationEnum::notificationTypes()[$single_notification->data['type']]}}
                    </a>
                </div>
            </div>
            <span class="badge badge-light fs-8">{{$single_notification->created_at->diffForHumans()}}</span>
        </div>
    @endforeach
@else
    <h3 class="text-center my-5">{{__("No Notification found")}}</h3>
@endif
