@extends('layout.home')

@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show text-center mb-3" role="alert">
                    <strong>Success:</strong> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h4 class="card-title mb-0">Events</h4>
                <form class="d-flex align-items-center w-50">
                    <input type="text" class="form-control" placeholder="Search Event">
                </form>
                <a class="btn btn-success create-new-button" href="{{ route('events.create') }}">+ Add Event</a>
            </div>

            <div class="table-responsive mt-3">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Location</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Action</th>



                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td>{{ $event->id }}</td>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->category->name}}</td>
                                <td>{{ $event->location}}</td>
                                <td>{{ $event->type}}</td>
                                <td>{{ $event->price}}</td>



                                <td>
                                    <a href="{{ route('events.edit', $event->id) }}" class="badge badge-success">Edit</a>
                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="badge badge-danger border-0">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>


@endsection