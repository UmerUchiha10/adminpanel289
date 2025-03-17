@extends('layout.user.mylayout')


@section('user_content')
<section >
    <div class="container">
        <header>
            <h2>Help & Tips</h2>
            <p>Get the most out of our image compressor</p>
        </header>
        <div class="help-content">
            <div class="help-card">
                <h3>How to Use</h3>
                <ol>
                    <li>Drag & drop images or click to select</li>
                    <li>Set your target size (default: 50KB)</li>
                    <li>Adjust quality and format if needed</li>
                    <li>Download individual images or all as ZIP</li>
                </ol>
            </div>
            <div class="help-card">
                <h3>Best Practices</h3>
                <ul>
                    <li>Use JPEG for photos, PNG for graphics</li>
                    <li>WebP offers best compression for web</li>
                    <li>Keep aspect ratio for best results</li>
                    <li>Set max dimensions for consistent output</li>
                </ul>
            </div>
        </div>
    </div>
</section>



@endsection