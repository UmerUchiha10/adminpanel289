<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Compressor to 50KB</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/browser-image-compression/2.0.0/browser-image-compression.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('User/assets/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('User/assets/blog-styles.css') }}">
    
    <style>
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }

        .blog-card {
            background: var(--card-bg);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .blog-card:hover {
            transform: translateY(-5px);
        }

        .blog-image {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .blog-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .post-category {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: var(--primary-color);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .blog-content {
            padding: 1.5rem;
        }

        .post-title {
            margin: 0 0 1rem;
            font-size: 1.25rem;
            color: var(--text-color);
        }

        .post-excerpt {
            color: var(--text-secondary);
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .post-meta {
            display: flex;
            justify-content: space-between;
            color: var(--text-muted);
            font-size: 0.875rem;
        }

        .blog-pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .blog-pagination button {
            padding: 0.5rem 1rem;
            border: 1px solid var(--border-color);
            background: var(--card-bg);
            color: var(--text-color);
            border-radius: 5px;
            cursor: pointer;
        }

        .blog-pagination button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
     <style>
        .post-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .post-header {
            text-align: center;
            margin-bottom: 40px;
        }
        .post-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .post-meta {
            color: var(--text-muted);
            margin-bottom: 20px;
        }
        .post-body {
            line-height: 1.8;
            font-size: 1.1em;
        }
        .related-posts {
            margin-top: 60px;
            padding: 40px 0;
            background: var(--input-bg);
        }
        .related-posts h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            padding: 0 20px;
        }
       
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-content">
            <div class="nav-logo">
                <i class="fas fa-compress"></i>
                <span>ImageCompressor</span>
            </div>
            <button class="nav-toggle" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <ul class="nav-links">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="{{ route('features') }}" class="{{ request()->routeIs('features') ? 'active' : '' }}"><i class="fas fa-sliders-h"></i> Features</a></li>
                <li><a href="{{ route('help') }}" class="{{ request()->routeIs('help') ? 'active' : '' }}"><i class="fas fa-question-circle"></i> Help</a></li>
                <li>
                    <a href="{{ route('blog') }}" class="{{ request()->routeIs('blog') || request()->routeIs('blogDetails') ? 'active' : '' }}">
                        <i class="fas fa-blog"></i> Blog
                    </a>
                </li>
                
                
                <li class="theme-toggle">
                    <button id="themeToggle" aria-label="Toggle theme">
                        <i class="fas fa-moon"></i>
                    </button>
                </li>
            </ul>
        </div>
    </nav>

    <main>
        @yield('user_content')
    </main>

    <script src="{{ asset('User/assets/script.js') }}"></script>
    <script src="{{ asset('User/assets/blog.js') }}"></script>

</body>
</html>

