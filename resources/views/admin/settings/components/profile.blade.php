<form method="POST" id="user-update">
    @csrf()
    <div class="form-group d-none">
        <label>ID</label>
        <input type="number" name="id" value="{{ Auth::user()->id ?? '' }}" class="form-control" readonly>
    </div>
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" value="{{ Auth::user()->name ?? '' }}" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" value="{{ Auth::user()->email ?? '' }}" class="form-control" readonly>
    </div>
    <div class="form-group">
        <label>Role</label>
        <input type="text" name="role" value="{{ Auth::user()->role ?? 'Guest' }}" class="form-control" readonly>
    </div>


    <div class="form-group text-center">
        <button class="btn btn-sm btn-primary m-t-n-xs w-100" type="submit"><strong>Submit</strong>
        </button>
    </div>
</form>
