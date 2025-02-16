@extends('layout')
@section('content')
    <div class="card">
        <div class="card-header">
            Create Contact:
        </div>
        <div class="card-body">
            <form method="post" action="{{ url('/contacts/' . $contacts->id) }}">
                {!! @csrf_field() !!}
                @method('PATCH')
                <input type="hidden" value="{{ $contacts->id }}" name="id" />
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" value="{{ $contacts->name }}" name="name" id="name">
                    <span style='color:red'>
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>



                <div class="mb-3">
                    <label for="phone_number" class="form-label">Contact Number</label>
                    <input type="number" class="form-control" value="{{ $contacts->phone_number }}" name="phone_number"
                        id="phone_number">
                    <span style='color:red'>
                        @error('phone_number')
                            {{ $message }}
                        @enderror
                    </span>

                </div>
                <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>


    </form>
    </div>
    </div>
@stop
