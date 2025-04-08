@if (Session::has('success'))
    <p class="alert alert-success">{{ Session::get('success') }}</p>
@elseif (Session::has('error'))
    <p class="alert alert-danger">{{ Session::get('error') }}</p>
@endif
