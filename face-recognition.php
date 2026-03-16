<?php
include 'includes/header.php';
?>

<!-- Include Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- Include face-api.js from newer CDN -->
<script src="https://cdn.jsdelivr.net/npm/@vladmandic/face-api@1.7.12/dist/face-api.js"></script>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Face Recognition System</h5>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="video-container position-relative mb-4">
                                <video id="video" width="720" height="560" autoplay muted></video>
                                <canvas id="canvas" class="position-absolute top-0 left-0"></canvas>
                            </div>
                            <div class="controls mb-4">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="text" id="personName" class="form-control" placeholder="Enter person's name">
                                            <div class="input-group-append">
                                                <button id="saveButton" class="btn btn-success">
                                                    <i class="fas fa-save"></i> Save Face
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button id="snap" class="btn btn-primary w-100">
                                            <i class="fas fa-camera"></i> Capture
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="known-faces-section">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Known Faces</h6>
                                    </div>
                                    <div class="card-body">
                                        <div id="knownFacesList" class="row">
                                            <!-- Known faces will be loaded here -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.video-container {
    position: relative;
    width: 100%;
    max-width: 720px;
    margin: 0 auto;
    background: #000;
    border-radius: 8px;
    overflow: hidden;
}

#video, #canvas {
    width: 100%;
    height: auto;
    max-width: 720px;
}

#canvas {
    position: absolute;
    top: 0;
    left: 0;
}

.known-faces-section {
    margin-top: 2rem;
}

.face-item {
    margin-bottom: 20px;
    text-align: center;
}

.face-item img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 50%;
    margin-bottom: 10px;
    border: 2px solid #ddd;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.face-info {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5px;
}

.face-info strong {
    display: block;
    margin-bottom: 5px;
}

.delete-face {
    padding: 3px 8px;
    font-size: 0.8rem;
}

.delete-face i {
    margin-right: 3px;
}

.controls {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
}
</style>

<script src="js/face-recognition.js"></script>

<?php
include 'includes/footer.php';
?> 