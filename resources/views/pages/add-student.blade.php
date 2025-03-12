@extends('main.app')

@section('content')

            <div class="wrapper wrapper-content">
                <div class="animated fadeInRightBig">
                    
                    <form action="{{ url('/insert-student-data') }}" method="post" enctype="multipart/form-data">
                        @csrf()
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Firstname</label>
                                    <input type="text" class="form-control" name="firstname" id="firstname" required>
 
                                </div>
                                <div class="form-group">
                                    <label for="">Middlename</label>
                                    <input type="text" class="form-control" name="middlename" id="middlename">
                                </div>
                                <div class="form-group">
                                    <label for="">lastname</label>
                                    <input type="text" class="form-control" name="lastname" id="lastname">
                                </div>
                                <div class="form-group">
                                    <label for="">Country</label>
                                    <select class="form-control" name="country_id" id="country_id">
                                            <option value="0">---</option>
                                            @foreach($country as $c)
                                            <option value="{{ $c->id }}">{{ $c->country }}</option>
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