@extends('layout.home')

@section('content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create Post</h4>

         
        
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
        
    
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="forms-sample">
                @csrf

                <!-- Post Title -->
                <div class="form-group">
                    <label for="title">Post Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter Post Title" value="{{ old('title') }}" required>
                </div>

            
                <!-- Category Selection -->
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="">Select a Category</option>
                         @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach 
                    </select>
                </div>

                <!-- Image Upload -->
                <div class="form-group">
                    <label>Image Upload</label>
                    <div class="input-group col-xs-12">
                        <input type="file" class="form-control file-upload-info" name="image" placeholder="Upload Image">
                       
                    </div>
                </div>

               

                <!-- Post Content -->
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="tinymc" class="form-control" rows="4" placeholder="Write your post here..." ></textarea>
                </div>

            

                <!-- Submit & Cancel Buttons -->
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </form>
        </div>
    </div>
</div>


@endsection