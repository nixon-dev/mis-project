@extends('main.app')


@section('content')
    
<div class="wrapper wrapper-content animated fadeInRight">

@if(Session::has('success'))
    <p class="alert alert-primary">{{ Session::get('success') }}</p>
@endif

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Student Data</h5>
                            <a href="{{ url('/add-student-form')}}">Add New Record</a>

                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-plus"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#" class="dropdown-item">Config option 1</a>
                                    </li>
                                    <li><a href="#" class="dropdown-item">Config option 2</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <table class="footable table table-stripped toggle-arrow-tiny">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>FIRST NAME</th>
                                    <th>MIDDLE NAME</th>
                                    <th>LASTNAME</th>
                                    
                                    <th>COUNTRY</th>
                                    <th>DATE</th>

                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($data as $d)
                                    <tr>
                                        <td> {{ $d->id }} </td>
                                        <td> {{ $d->firstname }} </td>
                                        <td> {{ $d->middlename }} </td>
                                        <td> {{ $d->lastname }} </td>
                                        <td> {{ $d->country }} </td>
                                        <td> {{ $d->birthdate }} </td>
                                        <td>
                                            <a href="{{ url('/delete-student/'.$d->id) }}" class="btn btn-danger" onclick="return confirm('Delete data?')">Delete</a>
                                            <a href="{{ url('/edit-student/'.$d->id) }}" class="btn btn-info">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">.:No Record Found:.</td>
                                    </tr>  
                                @endforelse 
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="5">
                                        <ul class="pagination float-right"></ul>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>
            </div>


            
</div>



@endsection

