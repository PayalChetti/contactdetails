@extends('layout')
@section('content')
    <div class="card">
        <div class="card-header">
            Create Contact:
        </div>
        <div class="card-body">
            <form method="post" action="{{ url('contacts') }}">
                {!! @csrf_field() !!}
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name">
                    <span style='color:red'>
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>



                <div class="mb-3">
                    <label for="phone_number" class="form-label">Contact Number</label>
                    <input type="number" class="form-control" name="phone_number" id="phone_number">
                    <span style='color:red'>
                        @error('phone_number')
                            {{ $message }}
                        @enderror
                    </span>

                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>


    </form>
    </div>
    </div>
@stop
