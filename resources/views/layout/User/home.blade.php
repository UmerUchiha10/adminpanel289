@extends('layout.user.mylayout')


@section('user_content')

    <section id="home" class="section active">
        <div class="container">
            <header>
                <h1>Image Compressor to 50KB</h1>
                <p>Free online tool to compress images with advanced controls</p>
            </header>

    <div class="compression-options">
        <div class="option-group">
            <label>Target Size (KB):</label>
            <input type="number" id="targetSize" value="50" min="1" max="1000">
        </div>
        
        <div class="option-group">
            <label>Quality:</label>
            <input type="range" id="quality" min="0" max="1" step="0.1" value="0.8">
            <span id="qualityValue">80%</span>
        </div>

        <div class="option-group">
            <label>Output Format:</label>
            <select id="outputFormat">
                <option value="auto">Auto (Same as Input)</option>
                <option value="image/jpeg">JPEG</option>
                <option value="image/png">PNG</option>
            </select>
        </div>

        <div class="option-group checkboxes">
            <label class="checkbox-label">
                <input type="checkbox" id="maintainAspectRatio" checked>
                Maintain Aspect Ratio
            </label>
            <label class="checkbox-label">
                <input type="checkbox" id="preventUpsizing" checked>
                Prevent Upsizing
            </label>
        </div>

        <div class="option-group dimensions">
            <label>Max Dimensions:</label>
            <div class="dimension-inputs">
                <input type="number" id="maxWidth" placeholder="Width" min="1" max="10000">
                <span>×</span>
                <input type="number" id="maxHeight" placeholder="Height" min="1" max="10000">
                <button id="resetDimensions" class="icon-button" title="Reset dimensions">↺</button>
            </div>
        </div>
    </div>

    <div class="upload-container" id="dropZone">
        <div class="upload-content">
            <img src="{{ asset('User/assets/upload-icon.svg') }}" alt="Upload" id="uploadIcon">
            <p>Drag & Drop your image here</p>
            <p>or</p>
            <input type="file" id="fileInput" accept="image/*" hidden>
            <button id="uploadButton">Choose File</button>
        </div>
    </div>

    <div class="batch-controls" id="batchControls" style="display: none;">
        <div class="progress-bar">
            <div class="progress" id="progressBar"></div>
        </div>
        <p class="progress-text">Processing: <span id="processedCount">0</span>/<span id="totalCount">0</span></p>
    </div>

    <div class="preview-container" id="previewContainer" style="display: none;">
        <div class="batch-preview" id="batchPreview"></div>
        <div class="batch-actions">
            <button id="downloadAllButton" class="download-btn">Download All (ZIP)</button>
            <button id="clearAllButton" class="clear-btn">Clear All</button>
        </div>
    </div>

    <template id="imagePreviewTemplate">
        <div class="image-preview-item">
            <div class="preview-header">
                <span class="filename"></span>
                <button class="remove-btn">×</button>
            </div>
            <div class="preview-content">
                <div class="original-image">
                    <h3>Original</h3>
                    <img class="preview-img">
                    <p>Size: <span class="original-size">0 KB</span></p>
                </div>
                <div class="compressed-image">
                    <h3>Compressed</h3>
                    <img class="preview-img">
                    <p>Size: <span class="compressed-size">0 KB</span></p>
                </div>
            </div>
            <button class="download-single-btn">Download</button>
        </div>
    </template>
    </section>
    


@endsection
