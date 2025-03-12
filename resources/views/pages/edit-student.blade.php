@extends('main.app')

@section('content')

            <div class="wrapper wrapper-content">
                <div class="animated fadeInRightBig">
                    
                    <form action="{{ url('/update-student-data') }}" method="post" enctype="multipart/form-data">
                        @csrf()
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Firstname</label>
                                    <input type="text" class="form-control" name="firstname" id="firstname" value="{{ $data[0]->firstname }}">
                                    <input type="hidden" class="form-control" name="id" id="id" value="{{ $data[0]->id }}">
                                    @error('firstname')
                                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Middlename</label>
                                    <input type="text" class="form-control" name="middlename" id="middlename" value="{{ $data[0]->middlename }}">
                                    @error('middlename')
                                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">lastname</label>
                                    <input type="text" class="form-control" name="lastname" id="lastname" value="{{ $data[0]->lastname }}">
                                    @error('lastname')
                                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Country</label>
                                    <select class="form-control" name="country_id" id="country_id">
                                            <option value="0">---</option>
                                            @foreach($country as $c)
                                            <option value="{{ $c->id }}" @selected($c->id == $data[0]->country_id)>{{ $c->country }}</option>
                                            @endforeach
                                    </select>    
                                    @error('country_id')
                                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Birthdate</label>
                                    <input type="date" class="form-control" name="birthdate" id="birthdate" value="{{ $data[0]->birthdate }}">
                                    @error('birthdate')
                                        <div class="alert alert-danger"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                                
                                <hr>
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
@endsection