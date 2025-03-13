@if (!empty(session('success')))
    <div class="alert alert-success text-center" role="alert">
        {{ session('success') }}
    </div>
@endif

@if (!empty(session('error')))
    <div class="alert alert-danger text-center" role="alert">
        {{ session('error') }}
    </div>
@endif
