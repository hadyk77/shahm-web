<table class="table table-bordered table-striped">
    <tr>
        <td>{{__("Transaction Code")}}</td>
        <td>{{$transaction->transaction_code}}</td>
    </tr>
    <tr>
        <td>{{__("Transaction Type")}}</td>
        <td>{{$transaction->title}}</td>
    </tr>
    <tr>
        <td>{{__("Transaction Amount")}}</td>
        <td>
           @if($transaction->is_added_price)
                <span class="svg-icon svg-icon-primary svg-icon-2x">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"></rect>
                        <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"></rect>
                    </svg>
                </span>
            @else
                <span class="svg-icon svg-icon-danger svg-icon-2x">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"></rect>
                    </svg>
                </span>
           @endif
            {{\App\Helper\Helper::price($transaction->price_amount)}}
        </td>
    </tr>
    <tr>
        <td>{{__("Transaction Notes")}}</td>
        <td>{{$transaction->notes ?? __("No notes available")}}</td>
    </tr>
    <tr>
        <td>{{__("Transaction Related To")}}</td>
        <td>
            @if(!is_null($transaction->user_id))
                {{$transaction->user->name}}
            @else
                {{$transaction->captain->name}}
            @endif
        </td>
    </tr>
    <tr>
        <td>{{__("Transaction Date")}}</td>
        <td>{{$transaction->created_at->format('Y-m-d H:i:s')}}</td>
    </tr>
</table>
