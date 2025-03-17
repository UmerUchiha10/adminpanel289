document.addEventListener('DOMContentLoaded', () => {
    // Theme handling
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = themeToggle.querySelector('i');
    let isDarkMode = false;

    // Sync theme with main site
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        enableDarkMode();
    }

    themeToggle.addEventListener('click', () => {
        isDarkMode = !isDarkMode;
        if (isDarkMode) {
            enableDarkMode();
        } else {
            disableDarkMode();
        }
        localStorage.setItem('theme', isDarkMode ? 'dark' : 'light');
    });

    function enableDarkMode() {
        isDarkMode = true;
        document.body.classList.add('dark-theme');
        themeIcon.className = 'fas fa-sun';
        updateThemeColors(true);
    }

    function disableDarkMode() {
        isDarkMode = false;
        document.body.classList.remove('dark-theme');
        themeIcon.className = 'fas fa-moon';
        updateThemeColors(false);
    }

    function updateThemeColors(isDark) {
        const root = document.documentElement;
        if (isDark) {
            root.style.setProperty('--nav-bg', '#1a1a1a');
            root.style.setProperty('--background-color', '#121212');
            root.style.setProperty('--text-color', '#ffffff');
            root.style.setProperty('--text-muted', '#888888');
            root.style.setProperty('--input-bg', '#2a2a2a');
            root.style.setProperty('--nav-active', '#2a2a2a');
            root.style.setProperty('--border-color', '#333333');
        } else {
            root.style.setProperty('--nav-bg', '#ffffff');
            root.style.setProperty('--background-color', '#f5f5f5');
            root.style.setProperty('--text-color', '#333333');
            root.style.setProperty('--text-muted', '#666666');
            root.style.setProperty('--input-bg', '#ffffff');
            root.style.setProperty('--nav-active', '#e8f5e9');
            root.style.setProperty('--border-color', '#dddddd');
        }
    }

    // Mobile menu handling
    const navToggle = document.querySelector('.nav-toggle');
    const navLinks = document.querySelector('.nav-links');

    navToggle.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        document.body.classList.toggle('nav-open');
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', (e) => {
        if (navLinks.classList.contains('active') && 
            !e.target.closest('.nav-links') && 
            !e.target.closest('.nav-toggle')) {
            navLinks.classList.remove('active');
            document.body.classList.remove('nav-open');
        }
    });

    // Blog posts data - This would typically come from a backend API
    const featuredPosts = [
        {
            id: 1,
            title: 'Ultimate Guide to Image Compression',
            excerpt: 'Learn the best practices for optimizing images without losing quality. Perfect for websites and social media.',
            image: 'https://picsum.photos/seed/featured1/800/400',
            category: 'tutorials',
            date: '2025-03-14',
            readTime: '8 min'
        },
        {
            id: 2,
            title: 'Top 5 Image Compression Tools Compared',
            excerpt: 'A detailed comparison of the most popular image compression tools in 2025. Find out which one suits your needs.',
            image: 'https://picsum.photos/seed/featured2/800/400',
            category: 'reviews',
            date: '2025-03-13',
            readTime: '6 min'
        },
        {
            id: 3,
            title: 'Image Optimization for E-commerce',
            excerpt: 'Boost your online store\'s performance with these image optimization techniques specifically for e-commerce.',
            image: 'https://picsum.photos/seed/featured3/800/400',
            category: 'tips',
            date: '2025-03-12',
            readTime: '5 min'
        }
    ];

    const blogPosts = [
        {
            id: 4,
            title: 'WebP vs JPEG: Which Format to Choose?',
            excerpt: 'A comprehensive comparison of WebP and JPEG formats, helping you make the right choice for your images.',
            image: 'https://picsum.photos/seed/post1/800/400',
            category: 'tutorials',
            date: '2025-03-11',
            readTime: '7 min'
        },
        {
            id: 5,
            title: 'Speed Up Your Website with Image Optimization',
            excerpt: 'Learn how proper image optimization can significantly improve your website\'s loading speed.',
            image: 'https://picsum.photos/seed/post2/800/400',
            category: 'tips',
            date: '2025-03-10',
            readTime: '4 min'
        },
        {
            id: 6,
            title: 'Best Image Compression Settings for Social Media',
            excerpt: 'Optimize your images for different social media platforms while maintaining quality.',
            image: 'https://picsum.photos/seed/post3/800/400',
            category: 'tips',
            date: '2025-03-09',
            readTime: '5 min'
        }
    ];

    // Populate featured posts
    // const featuredGrid = document.querySelector('.featured-grid');
    // featuredPosts.forEach(post => {
    //     featuredGrid.innerHTML += createFeaturedPostHTML(post);
    // });

    // Populate blog posts
    // const postsGrid = document.querySelector('.posts-grid');
    // blogPosts.forEach(post => {
    //     postsGrid.innerHTML += createBlogPostHTML(post);
    // });

    // Filter functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            const category = button.dataset.category;
            
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            // Filter posts
            const posts = postsGrid.querySelectorAll('.blog-post');
            posts.forEach(post => {
                if (category === 'all' || post.dataset.category === category) {
                    post.style.display = 'block';
                } else {
                    post.style.display = 'none';
                }
            });
        });
    });

    // Helper functions to create HTML
    function createFeaturedPostHTML(post) {
        return `
            <article class="featured-post">
                <img src="${post.image}" alt="${post.title}">
                <div class="featured-post-content">
                    <span class="post-category">${capitalizeFirstLetter(post.category)}</span>
                    <h3>${post.title}</h3>
                    <p>${post.excerpt}</p>
                    <div class="post-meta">
                        <span><i class="far fa-calendar"></i> ${formatDate(post.date)}</span>
                        <span><i class="far fa-clock"></i> ${post.readTime}</span>
                    </div>
                </div>
            </article>
        `;
    }

    function createBlogPostHTML(post) {
        return `
            <article class="blog-post" data-category="${post.category}">
                <img src="${post.image}" alt="${post.title}">
                <div class="blog-post-content">
                    <span class="post-category">${capitalizeFirstLetter(post.category)}</span>
                    <h3>${post.title}</h3>
                    <p>${post.excerpt}</p>
                    <div class="post-meta">
                        <span><i class="far fa-calendar"></i> ${formatDate(post.date)}</span>
                        <span><i class="far fa-clock"></i> ${post.readTime}</span>
                    </div>
                </div>
            </article>
        `;
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function formatDate(dateString) {
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('en-US', options);
    }
});
