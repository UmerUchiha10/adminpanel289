document.addEventListener('DOMContentLoaded', () => {
    // Section navigation
    const sections = document.querySelectorAll('.section');
    const navLinks = document.querySelectorAll('.nav-links a[data-section]');
    const navToggle = document.querySelector('.nav-toggle');
    const navLinksContainer = document.querySelector('.nav-links');
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = themeToggle.querySelector('i');
    let isDarkMode = false;

    // Function to update active section
    function updateActiveSection(targetId) {
        // Update active states
        navLinks.forEach(l => l.classList.remove('active'));
        const activeLink = document.querySelector(`.nav-links a[data-section="${targetId}"]`);
        if (activeLink) activeLink.classList.add('active');
        
        sections.forEach(section => {
            section.classList.remove('active');
            if (section.id === targetId) {
                section.classList.add('active');
            }
        });

        // Update URL hash
        history.pushState(null, '', `#${targetId}`);
    }

    // Check URL hash on page load
    // const initialSection = window.location.hash.slice(1) || 'home';
    // updateActiveSection(initialSection);

    // Handle browser back/forward navigation
    window.addEventListener('popstate', () => {
        const currentSection = window.location.hash.slice(1) || 'home';
        updateActiveSection(currentSection);
        document.getElementById(currentSection).scrollIntoView({ behavior: 'smooth' });
    });

    // Handle section navigation
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('data-section');
            updateActiveSection(targetId);

            // Close mobile menu if open
            navLinksContainer.classList.remove('active');
            document.body.classList.remove('nav-open');

            // Smooth scroll to section
            document.getElementById(targetId).scrollIntoView({ behavior: 'smooth' });
        });
    });

    // Mobile menu toggle
    navToggle.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        document.body.classList.toggle('nav-open');
    });

    // Close mobile menu when clicking outside
    // document.addEventListener('click', (e) => {
    //     if (navLinks.classList.contains('active') && 
    //         !e.target.closest('.nav-links') && 
    //         !e.target.closest('.nav-toggle')) {
    //         navLinks.classList.remove('active');
    //         document.body.classList.remove('nav-open');
    //     }
    // });

    // Theme toggle functionality
    themeToggle.addEventListener('click', () => {
        isDarkMode = !isDarkMode;
        document.body.classList.toggle('dark-theme');
        themeIcon.className = isDarkMode ? 'fas fa-sun' : 'fas fa-moon';
        
        // Update theme colors
        const root = document.documentElement;
        if (isDarkMode) {
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
    });

    
    // Advanced options elements
    const targetSizeInput = document.getElementById('targetSize');
    const qualityInput = document.getElementById('quality');
    const qualityValue = document.getElementById('qualityValue');
    const outputFormat = document.getElementById('outputFormat');
    const maintainAspectRatio = document.getElementById('maintainAspectRatio');
    const preventUpsizing = document.getElementById('preventUpsizing');
    const maxWidth = document.getElementById('maxWidth');
    const maxHeight = document.getElementById('maxHeight');
    const resetDimensions = document.getElementById('resetDimensions');

    // Initialize compression options
    let compressionOptions = {
        targetSize: 50,
        quality: 0.8,
        outputFormat: 'auto',
        maintainAspectRatio: true,
        preventUpsizing: true,
        maxWidth: null,
        maxHeight: null
    };

    // Setup advanced options event listeners
    targetSizeInput.addEventListener('change', () => {
        compressionOptions.targetSize = parseInt(targetSizeInput.value);
    });

    qualityInput.addEventListener('input', () => {
        const value = parseFloat(qualityInput.value);
        compressionOptions.quality = value;
        qualityValue.textContent = `${Math.round(value * 100)}%`;
    });

    outputFormat.addEventListener('change', () => {
        compressionOptions.outputFormat = outputFormat.value;
    });

    maintainAspectRatio.addEventListener('change', () => {
        compressionOptions.maintainAspectRatio = maintainAspectRatio.checked;
    });

    preventUpsizing.addEventListener('change', () => {
        compressionOptions.preventUpsizing = preventUpsizing.checked;
    });

    maxWidth.addEventListener('change', () => {
        compressionOptions.maxWidth = maxWidth.value ? parseInt(maxWidth.value) : null;
    });

    maxHeight.addEventListener('change', () => {
        compressionOptions.maxHeight = maxHeight.value ? parseInt(maxHeight.value) : null;
    });

    resetDimensions.addEventListener('click', () => {
        maxWidth.value = '';
        maxHeight.value = '';
        compressionOptions.maxWidth = null;
        compressionOptions.maxHeight = null;
    });
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const uploadButton = document.getElementById('uploadButton');
    const previewContainer = document.getElementById('previewContainer');
    const batchPreview = document.getElementById('batchPreview');
    const batchControls = document.getElementById('batchControls');
    const progressBar = document.getElementById('progressBar');
    const processedCount = document.getElementById('processedCount');
    const totalCount = document.getElementById('totalCount');
    const downloadAllButton = document.getElementById('downloadAllButton');
    const clearAllButton = document.getElementById('clearAllButton');
    
    // Store processed images
    const processedImages = new Map();

    // Handle drag and drop events
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.classList.add('drag-over');
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.classList.remove('drag-over');
        });
    });

    // Setup event listeners
    dropZone.addEventListener('drop', handleDrop);
    uploadButton.addEventListener('click', () => fileInput.click());
    fileInput.addEventListener('change', handleFileSelect);
    downloadAllButton.addEventListener('click', downloadAllImages);
    clearAllButton.addEventListener('click', resetUI);

    // Update file input to accept multiple files
    fileInput.setAttribute('multiple', 'true');

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }

    function handleFileSelect(e) {
        const files = e.target.files;
        handleFiles(files);
    }

    async function handleFiles(files) {
        const imageFiles = Array.from(files).filter(file => file.type.startsWith('image/'));
        
        if (imageFiles.length === 0) {
            alert('Please upload image files only.');
            return;
        }

        // Show controls and preview container
        batchControls.style.display = 'block';
        previewContainer.style.display = 'block';
        
        // Update progress indicators
        totalCount.textContent = imageFiles.length;
        processedCount.textContent = '0';
        progressBar.style.width = '0%';

        // Process each image
        for (let i = 0; i < imageFiles.length; i++) {
            const file = imageFiles[i];
            try {
                await processImage(file);
                
                // Update progress
                processedCount.textContent = (i + 1).toString();
                progressBar.style.width = `${((i + 1) / imageFiles.length) * 100}%`;
            } catch (error) {
                console.error(`Error processing ${file.name}:`, error);
            }
        }
    }

    async function processImage(file) {
        // Calculate sizes
        const fileSizeMB = file.size / (1024 * 1024);
        const targetSizeMB = compressionOptions.targetSize / 1024;

        // Get original image dimensions and analyze image characteristics
        const originalImage = new Image();
        await new Promise((resolve) => {
            originalImage.onload = resolve;
            originalImage.src = URL.createObjectURL(file);
        });

        // Adaptive quality settings based on image size and dimensions
        let adaptiveQuality = compressionOptions.quality;
        const aspectRatio = originalImage.width / originalImage.height;

        // Adjust quality based on image characteristics
        if (fileSizeMB > 5) {
            // For larger files, use smarter quality adjustment
            if (aspectRatio > 2 || aspectRatio < 0.5) {
                // Panoramic or tall images need higher quality
                adaptiveQuality = Math.min(0.92, compressionOptions.quality + 0.12);
            } else {
                adaptiveQuality = Math.min(0.88, compressionOptions.quality + 0.08);
            }
        } else if (fileSizeMB > 2) {
            adaptiveQuality = Math.min(0.85, compressionOptions.quality + 0.05);
        }

        // Calculate optimal dimensions with smarter scaling
        let maxDimension = Math.max(originalImage.width, originalImage.height);
        let optimalDimension = maxDimension;

        // Progressive dimension reduction for large images
        if (maxDimension > 4000) {
            // Very large images
            optimalDimension = Math.round(maxDimension * 0.65);
        } else if (maxDimension > 2000) {
            // Large images
            optimalDimension = Math.round(maxDimension * 0.85);
        }

        // Ensure dimensions are even numbers for better compression
        optimalDimension = Math.floor(optimalDimension / 2) * 2;

        // Use user-specified dimensions if provided
        if (compressionOptions.maxWidth || compressionOptions.maxHeight) {
            optimalDimension = Math.max(
                compressionOptions.maxWidth || Infinity,
                compressionOptions.maxHeight || Infinity
            );
        }

        // Prepare compression options with enhanced adaptive settings
        const options = {
            maxSizeMB: targetSizeMB,
            maxWidthOrHeight: optimalDimension,
            useWebWorker: true,
            quality: adaptiveQuality,
            alwaysKeepResolution: !compressionOptions.preventUpsizing,
            maintainAspectRatio: compressionOptions.maintainAspectRatio,
            initialQuality: adaptiveQuality,
            maxIteration: 15,  // Increased iterations for better quality optimization
            webWorkerPath: undefined,
            // Add advanced options for better quality
            exifOrientation: true,  // Preserve image orientation
            strict: false  // Allow slight size variations for better quality
        };

        // Set specific dimensions if provided
        if (compressionOptions.maxWidth && compressionOptions.maxHeight) {
            options.maxWidth = compressionOptions.maxWidth;
            options.maxHeight = compressionOptions.maxHeight;
        }

        // Handle output format
        if (compressionOptions.outputFormat !== 'auto') {
            options.fileType = compressionOptions.outputFormat;
        }

        // Create preview element
        const template = document.getElementById('imagePreviewTemplate');
        const previewElement = template.content.cloneNode(true).children[0];
        batchPreview.appendChild(previewElement);

        // Set filename
        previewElement.querySelector('.filename').textContent = file.name;

        // Set up original preview
        const originalUrl = URL.createObjectURL(file);
        const originalImg = previewElement.querySelector('.original-image .preview-img');
        originalImg.src = originalUrl;
        previewElement.querySelector('.original-size').textContent = 
            `${(file.size / 1024).toFixed(2)} KB (${originalImage.width}×${originalImage.height})`;

        try {
            // Compress image
            let compressedFile = await imageCompression(file, options);
            
            // Handle format conversion if needed
            // if (options.fileType && options.fileType !== file.type) {
            //     const blob = await fetch(compressedFile).then(r => r.blob());
            //     compressedFile = new File([blob], file.name.split('.')[0] + '.' + options.fileType.split('/')[1], {
            //         type: options.fileType
            //     });
            // }
            if (options.fileType && options.fileType !== file.type) {
                const blob = new Blob([compressedFile], { type: options.fileType });
    
                // ✅ Fix #2: Correct File Extension Handling
                const extension = options.fileType.split('/')[1] || 'jpg'; 
                compressedFile = new File([blob], `${file.name.split('.')[0]}.${extension}`, {
                    type: options.fileType
                });
            }
            // console.log(options.fileType);
            const compressedUrl = URL.createObjectURL(compressedFile);

            // Get compressed dimensions
            const compressedImg = new Image();
            await new Promise((resolve) => {
                compressedImg.onload = resolve;
                compressedImg.src = compressedUrl;
            });

            // Update preview
            const compressedPreview = previewElement.querySelector('.compressed-image .preview-img');
            compressedPreview.src = compressedUrl;

            // Calculate compression ratio and format info
            const compressionRatio = ((file.size - compressedFile.size) / file.size * 100).toFixed(1);
            const formatInfo = compressedFile.type.split('/')[1].toUpperCase();

            // Update size and info
            previewElement.querySelector('.compressed-size').textContent = 
                `${(compressedFile.size / 1024).toFixed(2)} KB (${compressedImg.width}×${compressedImg.height})`;

            // Add compression info
            const compressionInfo = document.createElement('p');
            compressionInfo.className = 'compression-info';
            compressionInfo.textContent = `${compressionRatio}% smaller • ${formatInfo}`;
            previewElement.querySelector('.compressed-image').appendChild(compressionInfo);

            // Store processed image
            processedImages.set(file.name, {
                original: { url: originalUrl, file },
                compressed: { url: compressedUrl, file: compressedFile }
            });

            // Setup single download button
            const downloadButton = previewElement.querySelector('.download-single-btn');
            downloadButton.onclick = () => downloadImage(file.name);

            // Setup remove button
            const removeButton = previewElement.querySelector('.remove-btn');
            removeButton.onclick = () => {
                processedImages.delete(file.name);
                previewElement.remove();
                if (processedImages.size === 0) {
                    resetUI();
                }
            };
        } catch (error) {
            console.error('Error compressing image:', error);
            previewElement.querySelector('.compressed-image').innerHTML = 
                '<p class="error-message">Error compressing image. Please try different settings.</p>';
        }
    }

    // function downloadImage(filename) {
    //     const image = processedImages.get(filename);
    //     if (image) {
    //         const link = document.createElement('a');
    //         link.href = image.compressed.url;
    //         link.download = `compressed_${filename}`;
    //         link.click();
    //     }
    // }

    function downloadImage(filename) {
        const image = processedImages.get(filename);
        if (image) {
            const fileType = image.compressed.file.type.split('/')[1]; // Extract correct file extension
            const newFilename = `compressed_${filename.split('.')[0]}.${fileType}`; // Ensure correct extension
            const link = document.createElement('a');
            link.href = image.compressed.url;
            link.download = newFilename;
            link.click();
        }
    }
    

    async function downloadAllImages() {
        if (processedImages.size === 0) return;

        const zip = new JSZip();
        const promises = [];

        processedImages.forEach((image, filename) => {
            const promise = fetch(image.compressed.url)
                .then(response => response.blob())
                .then(blob => {
                    zip.file(`compressed_${filename}`, blob);
                });
            promises.push(promise);
        });

        await Promise.all(promises);
        const blob = await zip.generateAsync({type: 'blob'});
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'compressed_images.zip';
        link.click();
    }

    function resetUI() {
        batchPreview.innerHTML = '';
        batchControls.style.display = 'none';
        previewContainer.style.display = 'none';
        processedImages.clear();
    }

    // Blog functionality
    // const blogGrid = document.getElementById('blogGrid');
    
    // Function to create a blog post element
    // function createBlogPost(post) {
    //     const article = document.createElement('article');
    //     article.className = 'blog-card';
        
    //     let content = `
    //         <h3>${post.title}</h3>
    //         <p class="blog-meta">${post.created_at}</p>
    //     `;
        
    //     if (post.image) {
    //         content += `<img src="${post.image}" alt="${post.title}" class="blog-image">`;
    //     }
        
    //     content += `
    //         <p>${post.content.length > 150 ? post.content.substring(0, 150) + '...' : post.content}</p>
    //         <button class="read-more" onclick="showFullPost(${JSON.stringify(post).replace(/"/g, '&quot;')})">Read More</button>
    //     `;
        
    //     article.innerHTML = content;
    //     return article;
    // }

    // // Function to show full post in a modal
    // window.showFullPost = function(post) {
    //     const modal = document.createElement('div');
    //     modal.className = 'modal';
    //     modal.innerHTML = `
    //         <div class="modal-content">
    //             <span class="close-modal">&times;</span>
    //             <h2>${post.title}</h2>
    //             <p class="blog-meta">${post.created_at}</p>
    //             ${post.image ? `<img src="${post.image}" alt="${post.title}" class="blog-image">` : ''}
    //             <div class="blog-content">${post.content}</div>
    //         </div>
    //     `;

    //     document.body.appendChild(modal);
    //     modal.querySelector('.close-modal').onclick = () => modal.remove();
        
    //     // Close modal when clicking outside
    //     modal.onclick = (e) => {
    //         if (e.target === modal) modal.remove();
    //     };
    // }

    // // Function to load blog posts
    // async function loadBlogPosts() {
    //     try {
    //         const response = await fetch('get_posts.php');
    //         const posts = await response.json();
            
    //         blogGrid.innerHTML = '';
            
    //         if (posts.length === 0) {
    //             blogGrid.innerHTML = `
    //                 <div class="empty-state">
    //                     <i class="fas fa-newspaper"></i>
    //                     <h2>No Posts Yet</h2>
    //                     <p>Check back later for new articles!</p>
    //                 </div>
    //             `;
    //             return;
    //         }
            
    //         posts.forEach(post => {
    //             blogGrid.appendChild(createBlogPost(post));
    //         });
    //     } catch (error) {
    //         console.error('Error loading blog posts:', error);
    //         blogGrid.innerHTML = `
    //             <div class="error-state">
    //                 <i class="fas fa-exclamation-circle"></i>
    //                 <h2>Error Loading Posts</h2>
    //                 <p>Please try again later.</p>
    //             </div>
    //         `;
    //     }
    // }

    // Load blog posts when the blog section becomes active
    // const blogSection = document.getElementById('blog');
    // const observer = new MutationObserver((mutations) => {
    //     mutations.forEach((mutation) => {
    //         if (mutation.target.classList.contains('active')) {
    //             loadBlogPosts();
    //         }
    //     });
    // });
    
    // observer.observe(blogSection, { attributes: true });
});

// Add modal styles to the document
const modalStyles = document.createElement('style');
modalStyles.textContent = `
    .modal {
        display: flex;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background: var(--nav-bg);
        padding: 2rem;
        border-radius: 10px;
        max-width: 800px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        position: relative;
        color: var(--text-color);
    }

    .close-modal {
        position: absolute;
        top: 1rem;
        right: 1rem;
        font-size: 1.5rem;
        cursor: pointer;
        color: var(--text-muted);
        transition: color 0.3s ease;
    }

    .close-modal:hover {
        color: var(--text-color);
    }

    .blog-image {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
        margin: 1rem 0;
    }

    .blog-content {
        line-height: 1.6;
        color: var(--text-color);
    }

    .error-state,
    .empty-state {
        text-align: center;
        padding: 3rem;
        color: var(--text-muted);
    }

    .error-state i,
    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: var(--text-muted);
    }

    .blog-card .blog-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        margin: 1rem 0;
    }
`;
document.head.appendChild(modalStyles);
