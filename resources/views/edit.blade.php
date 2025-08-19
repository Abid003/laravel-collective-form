@extends('welcome')

@section('title', 'Edit Student')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">Edit Student</div>
                <div class="card-body">

                    {{-- Open Form --}}
                    {!! Form::model($student, ['route' => ['updateStudent', $student->id], 'method' => 'PUT', 'files' => true]) !!}

                    {{-- Student Table Fields --}}
                    <div class="mb-3">
                        {!! Form::label('name', 'Full Name', ['class' => 'form-label']) !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
                        {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        {!! Form::label('phone', 'Phone', ['class' => 'form-label']) !!}
                        {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                        @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Profile Table Fields --}}
                    <div class="mb-3">
                        {!! Form::label('address', 'Address', ['class' => 'form-label']) !!}
                        {!! Form::textarea('address', $student->profile->address ?? null, ['class' => 'form-control', 'rows' => 2]) !!}
                        @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        {!! Form::label('dob', 'Date of Birth', ['class' => 'form-label']) !!}
                        {!! Form::date('dob', $student->profile->dob ?? null, ['class' => 'form-control']) !!}
                        @error('dob') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        {!! Form::label('photo', 'Profile Picture', ['class' => 'form-label']) !!}
                        {!! Form::file('photo', ['class' => 'form-control']) !!}
                        @if($student->profile->photo)
                            <img src="{{ asset('storage/photos/'.$student->profile->photo) }}" width="100" class="mt-2">
                        @endif
                        <small class="text-muted">Upload profile photo (jpg, png)</small>
                        @error('photo') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Submit --}}
                    <div class="mb-3 text-center">
                        {!! Form::submit('Update Student', ['class' => 'btn btn-success']) !!}
                    </div>

                    {!! Form::close() !!}
                    {{-- End Form --}}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
