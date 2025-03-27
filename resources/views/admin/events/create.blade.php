@extends('layout.home')

@section('content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create Event</h4>

         
        
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="forms-sample">
            @csrf
        
            <div class="form-group">
                <label for="name">Event Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter event name" value="{{ old('name') }}" required>
            </div>
        
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" placeholder="Enter event description" required rows="8">{{ old('description') }}</textarea>
            </div>
        
            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" name="category_id" id="category_id" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        
            <div class="form-group">
                <label for="Location">Location</label>
                <select class="form-control" name="location" id="Location" required>
                    <option value="">Select Location</option>
                    <option value="lahore">Lahore</option>
                    <option value="islamabad">Islamabad</option>
                    <option value="karachi">Karachi</option>
                    <option value="faisalabad">Faisalabad</option>


                </select>
            </div>
        
            <div class="form-group">
                <label for="type">Event Type</label>
                <select class="form-control" name="type" id="type" required>
                    <option value="">Select Type</option>
                    <option value="free">Free</option>
                    <option value="paid">Paid</option>
                </select>
            </div>
        
            <div class="form-group">
                <label for="price">Price (in PKR)</label>
                <input type="number" class="form-control" name="price" id="price" placeholder="Enter price" value="{{ old('price', 0) }}" min="0" required>
            </div>
        
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
            </div>
        
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" class="form-control" name="end_date" id="end_date" value="{{ old('end_date') }}" required>
            </div>
        
            <div class="form-group">
                <label for="max_attendees">Max Attendees</label>
                <input type="number" class="form-control" name="max_attendees" id="max_attendees" placeholder="Enter max attendees" value="{{ old('max_attendees', 1) }}" min="1" required>
            </div>
        
            <!-- Submit & Cancel Buttons -->
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
        
        </div>
    </div>
</div>


@endsection