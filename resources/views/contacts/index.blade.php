@extends('layout')

@section('content')
    <div class="card">


        <div class="card-header">
            <h2>All Contacts</h2>
            @if (session('flash message'))
                <span style="color:red; text-align:center">{{ session('flash message') }}</span>
            @endif
        </div>
        <div class="card-body">


            <div style="float: left;">
                <form action="{{ url('import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="xml_file">
                    <button class="btn btn-secondary btn-sm"><i class="fa fa-import" area-hidden='true'>Import
                            Data</i></button>
                </form>
            </div>
            <div style="float: right;">
                <a href={{ url('/contacts/create') }} class="btn btn-success btn-sm" title="Add New Contact">
                    <i class="fa fa-plus" area-hidden="true"></i>Add New Contact
                </a>
            </div>



            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($contacts as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone_number }}</td>
                            <td><a href="{{ '/contacts/' . $item->id }}"><button
                                        class="btn btn-info btn-sm">View</button></a>
                                <a href="{{ '/contacts/' . $item->id . '/edit' }}"><button
                                        class="btn btn-primary btn-sm">Edit</button></a>
                                <form method="post" style="display:inline"
                                    action="{{ url('/contacts' . '/' . $item->id) }}">
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
