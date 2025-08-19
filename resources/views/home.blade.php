@extends('welcome')

@section('title', 'All Students')

@section('content')
<div class="container my-3">

    {{-- Success / Error Messages --}}
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

    {{-- Add New Button --}}
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('createNew') }}" class="btn btn-primary">Add New Student</a>
    </div>

    {{-- Students Table --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Date of Birth</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $index => $student)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->phone }}</td>
                        <td>{{ $student->profile->address ?? '-' }}</td>
                        <td>{{ $student->profile->dob ?? '-' }}</td>
                        <td>
                            @if(isset($student->profile->photo))
                                <img src="{{ asset('storage/photos/' . $student->profile->photo) }}" 
                                     alt="Photo" width="50" height="50">
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('editStudent', $student->id) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No students found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
