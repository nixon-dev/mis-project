@extends('admin.base')

@section('content')
    <div class="wrapper wrapper-content">
        <div class="animated fadeInDown">

            <form action="{{ url('/') }}" method="post" enctype="multipart/form-data">
                @csrf()
                <div class="row">
                    <div class="col-4">
                       
                        <div class="form-group">
                            <label for="">Office</label>
                            <select class="form-control" name="office_id" id="office_id">
                                <option value="0" selected disabled>Office</option>
                                @foreach ($office as $o)
                                    <option value="{{ $o->office_id }}">{{ $o->office_name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="">Birthdate</label>
                            <input type="date" class="form-control" name="birthdate" id="birthdate">
                        </div>

                        <hr>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
