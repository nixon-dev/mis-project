<form action="{{ route('admin.user-update-password') }}" method="POST" autocomplete="off">

    @csrf()
   
    <div class="form-group d-none">
        <label>Email</label>
        <input type="email" name="email" value="{{ Auth::user()->email ?? '' }}" class="form-control" readonly>
    </div>
    <div class="form-group">
        <label>Old Password</label>
        <input type="password" name="old_password" class="form-control" required>
    </div>
    <div class="form-group">
        <label>New Password</label>
        <input type="password" name="new_password" id="new_password" class="form-control"
            autocomplete="new-password" minlength="6" required>
    </div>
    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password"
            autocomplete="new-password" minlength="6" class="form-control" required>
    </div>
    <div class="form-group d-none">
        <label>ID</label>
        <input type="number" name="id" value="{{ Auth::user()->id ?? '' }}" class="form-control"
            readonly>
    </div>

    <div class="form-group text-center">
        <button class="btn btn-sm btn-primary m-t-n-xs w-100" type="submit"><strong>Update
                Password</strong>
        </button>
    </div>
</form>