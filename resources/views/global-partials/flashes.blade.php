<script>
    @if(Session::get("error"))
    Swal.fire({
        text: "{{Session::get("error")}}",
        icon: "error",
        buttonsStyling: false,
        confirmButtonText: "{{__("Ok, got it!")}}",
        customClass: {
            confirmButton: "btn btn-danger"
        }
    });
    @endif


    @if(Session::get("success"))
    Swal.fire({
        text: "{{Session::get("success")}}",
        icon: "success",
        buttonsStyling: false,
        confirmButtonText: "{{__("Ok, got it!")}}",
        customClass: {
            confirmButton: "btn btn-primary"
        }
    });
    @endif



    @if($errors->count() > 0)
    @php
        $errorMessages = "";
        foreach($errors->all() as $error){
            $errorMessages .= $error . "<br />";
        }
    @endphp
    Swal.fire({
        icon: "error",
        buttonsStyling: false,
        html: "{!! $errorMessages !!}",
        confirmButtonText: "{{__("Ok, got it!")}}",
        customClass: {
            confirmButton: "btn btn-danger"
        }
    });
    @endif
</script>
