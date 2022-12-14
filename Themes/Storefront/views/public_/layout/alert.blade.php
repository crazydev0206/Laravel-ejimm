@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" data-dismiss="alert" class="close">
            <i class="las la-times"></i>
        </button>

        <i class="las la-check-circle"></i>

        {{ session('success') }}
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" data-dismiss="alert" class="close">
            <i class="las la-times"></i>
        </button>

        <i class="las la-check-circle"></i>

        {{ session('error') }}
    </div>
@endif
