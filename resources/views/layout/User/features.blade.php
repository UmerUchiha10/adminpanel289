@extends('layout.user.mylayout')


@section('user_content')
<section>
    <div class="container">
        <header>
            <h2>Features</h2>
            <p>Advanced tools for perfect image compression</p>
        </header>
        <div class="features-grid">
            <div class="feature-card">
                <i class="fas fa-compress"></i>
                <h3>Smart Compression</h3>
                <p>Automatically finds the best compression settings for your target size</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-images"></i>
                <h3>Batch Processing</h3>
                <p>Process multiple images at once with consistent settings</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-magic"></i>
                <h3>Format Conversion</h3>
                <p>Convert between JPEG, PNG, and WebP formats</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-crop"></i>
                <h3>Size Control</h3>
                <p>Set maximum dimensions while maintaining aspect ratio</p>
            </div>
        </div>
    </div>
</section>



@endsection