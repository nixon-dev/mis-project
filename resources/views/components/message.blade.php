<script>
    @if (Session::has('success'))
        Swal.fire({
            title: "Success!",
            text: "{{ session('success') }}",
            icon: "success",
            timer: 3000,
            showConfirmButton: false
        });
    @elseif (Session::has('error'))
        Swal.fire({
            title: "Error!",
            text: "{{ session('error') }}",
            icon: "error",
            timer: 3000,
            showConfirmButton: false
        });
    @endif
</script>
