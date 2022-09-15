<script>
    $.extend(true, $.fn.dataTable.defaults, {
        "ajax": {
            url: "{!! $route !!}",
            data: function (d) {
                return $.extend({}, d, {
                    @if(request()->routeIs("admin.user.index") || request()->routeIs("admin.captain.index"))
                        status: $('.form-content').find("#status").val(),
                    @endif
                    @if(request()->routeIs("admin.order.index"))
                        status: $('#order_status').val(),
                    @endif
                    @if(request()->routeIs("admin.transactions.index"))
                        client_id: $('#client_id').val(),
                        captain_id: $('#captain_id').val(),
                        txn_code: $('#transcation_code').val(),
                        date_range: $('#date_range').val(),
                    @endif
                })
            }
        },
        columns: [
            {data: 'id', name: "id"},
    @foreach($columns as $key => $column)
    @if(is_array($column))
        {data: '{{$key}}', name: '{!! $column[0] !!}', @if(in_array($key, ['image', 'icon', 'qr_code', 'created_at', "updated_at", "status", "best_selling", "is_available"])) searchable: false, orderable: false, @endif },
    @else
        {data: '{!! $column !!}', name: '{!! $column !!}', @if(in_array($column, ['image', 'icon', 'qr_code', 'created_at', "updated_at", "status", "best_selling", "is_available"])) searchable: false, orderable: false, @endif },
    @endif
    @endforeach
        {data: 'action', searchable: false, orderable: false}
        ]
    });
</script>
