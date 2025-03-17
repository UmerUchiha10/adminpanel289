@extends('layout.home')

@section('content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Post</h4>

            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Validation Errors -->
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

            <!-- Edit Post Form -->
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="forms-sample">
                @csrf
                @method('PUT')

                <!-- Post Title -->
                <div class="form-group">
                    <label for="title">Post Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $post->title) }}" required>
                </div>

                <!-- Category Selection -->
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="">Select a Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Image Upload -->
                <div class="form-group">
                    <label>Image Upload</label>
                    <div class="input-group col-xs-12">
                        <input type="file" class="form-control file-upload-info" name="image">
                    </div>
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image" class="mt-2" width="100">
                    @endif
                </div>

                <!-- Post Content -->
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="tinymc" class="form-control" rows="4" required>{{ old('content', $post->content) }}</textarea>
                </div>


                <!-- Submit & Cancel Buttons -->
                <button type="submit" class="btn btn-primary mr-2">Update Post</button>
                <a href="{{ route('posts.index') }}" class="btn btn-light">Cancel</a>
            </form>
        </div>
    </div>
</div>



@endsection