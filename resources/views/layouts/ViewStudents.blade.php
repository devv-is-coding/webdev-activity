@extends('layouts.base')

@section('title', 'Student List')

@section('content')

<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand">STD</a>
    <h3>Student List</h3>
    <form class="d-flex" role="search">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
        Add Students
    </button>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn btn-primary">
          Log out
      </button>
  </form>  
    </form>
  </div>
</nav>

    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif
    <!-- Button trigger modal -->
    <div class="row">
        <div class="col-12">
            <h4>Students: </h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Address</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <th scope="row">{{ $student->id }}</th>
                            <th>{{ $student->name }}</th>
                            <th>{{ $student->age }}</th>
                            <th>{{ $student->gender }}</th>
                            <th>{{ $student->address }}</th>
                            <th>
                                <button type="button" class="btn btn-warning btn-sm updateStudentBtn"
                                data-id="{{ $student->id }}"
                                data-name="{{ $student->name }}"
                                data-age="{{ $student->age }}"
                                data-gender="{{ $student->gender }}"
                                data-address="{{ $student->address }}"
                                data-bs-toggle="modal" data-bs-target="#updateStudentModal">
                                Update
                            </button>
                            </th>
                            <th><form method="POST" action="{{ route('std.delete', $student->id) }}">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

       <!-- Modal -->
       <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addStudentModalLabel">Add Student</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('std.create') }}">
                      @csrf
                      <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="exampleFormControlInput1" placeholder="Enter your name">
                        @error('name')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="text" class="form-control" name="age" value="{{ old('age') }}" id="exampleFormControlInput1" placeholder="Enter your age">
                        @error('age')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <input type="text" class="form-control" name="gender" value="{{ old('gender') }}" id="exampleFormControlInput1" placeholder="Enter your gender">
                        @error('gender')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="{{ old('address') }}" id="exampleFormControlInput1" placeholder="Enter your address">
                        @error('address')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updateStudentModal" tabindex="-1" aria-labelledby="updateStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateStudentModalLabel">Update Student</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="updateStudentForm">
                        @csrf
                        @method('PUT')
                      <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="updateStudentName" placeholder="Enter your name">
                        @error('name')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="text" class="form-control" name="age" value="{{ old('age') }}" id="updateStudentAge" placeholder="Enter your age">
                        @error('age')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <input type="text" class="form-control" name="gender" value="{{ old('gender') }}" id="updateStudentGender" placeholder="Enter your gender">
                        @error('gender')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="{{ old('address') }}" id="updateStudentAddress" placeholder="Enter your address">
                        @error('address')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
