@extends('layout.user.mylayout')


@section('user_content')
<section>
    <div class="">
    
        <header class="blog-header">
            <div class="container">
                <h1>Image Compression Blog</h1>
                <p>Tips, tutorials, and best practices for image optimization</p>
            </div>
        </header>

        <section class="featured-posts">
            <div class="container">
                <h2>Featured Articles</h2>
                <div class="featured-grid">
                    <!-- Featured posts will be dynamically inserted here -->
                
                    @foreach ($posts as $post)
                        <article class="featured-post">
                            <a href="{{ route('blogDetails', $post->slug) }}">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->slug }}">

                            </a>
                            <div class="featured-post-content" bis_skin_checked="1">
                                <span class="post-category">{{ $post->category->slug ?? 'Uncategorized' }}</span>
                                <h3>{{ $post->title }}</h3>
                                <p>{{ Str::limit(strip_tags($post->content), 100) }}</p>
                                <div class="post-meta" bis_skin_checked="1">
                                    <span><i class="far fa-calendar"></i>{{ $post->created_at->format('M d, Y') }}</span>
                                    <span><i class="far fa-clock"></i>{{ $post->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </article>
                   
                    @endforeach
                  
                </div>
            </div>
        </section>

       
        <section class="blog-posts">
            <div class="container">
                <div class="posts-header">
                    <h2>Latest Posts</h2>
                    <div class="posts-filter">
                        <!-- "All" button -->
                        <button class="filter-btn active" data-category="all">All</button>
                
                        <!-- Loop through categories -->
                        @foreach ($categories as $category)
                            <button class="filter-btn" data-category="{{ $category->slug }}">
                                {{ $category->name }}
                            </button>
                        @endforeach
                    </div>
                </div>
                
                <div class="posts-grid">
                    <!-- Blog posts will be dynamically inserted here -->
                  

                    @foreach ($posts as $post)
                        <article class="blog-post" data-category="{{ $post->category->slug ?? 'uncategorized' }}" style="display: block;">
                            <a href="{{ route('blogDetails', ['slug' => $post->slug]) }}">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->slug }}">

                            </a>
                            <div class="blog-post-content">
                                <span class="post-category">{{ $post->category->name ?? 'Uncategorized' }}</span>
                                <h3>{{ $post->title }}</h3>
                                <p>{{ Str::limit(strip_tags($post->content), 100) }}</p>
                                <div class="post-meta">
                                    <span><i class="far fa-calendar"></i>{{ $post->created_at->format('M d, Y') }}</span>
                                    <span><i class="far fa-clock"></i>{{ $post->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </article>
                  
                    @endforeach
                    
                </div>
                <div class="posts-loading">
                    <i class="fas fa-spinner fa-spin"></i>
                    <p>Loading posts...</p>
                </div>
            </div>
        </section>
        @include('layout.user.footer')
    </div>
</section>

<script>

document.addEventListener("DOMContentLoaded", function () {
    const filterButtons = document.querySelectorAll(".filter-btn");
    const posts = document.querySelectorAll(".blog-post");

    filterButtons.forEach(button => {
        button.addEventListener("click", function () {
            filterButtons.forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");

            const category = this.getAttribute("data-category");

            posts.forEach(post => {
                const postCategory = post.getAttribute("data-category");

                if (category === "all" || postCategory === category) {
                    post.style.display = "block";
                } else {
                    post.style.display = "none";
                }
            });
        });
    });
});


</script>



@endsection