<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Treasure | ExploreLocal</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Add these after your existing CSS links -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <style>
        :root {
            --primary: #6c5ce7;
            --secondary: #a29bfe;
            --accent: #fd79a8;
            --dark: #2d3436;
            --light: #f5f6fa;
            --success: #00b894;
            --warning: #fdcb6e;
            --danger: #d63031;
            --info: #0984e3;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--light);
            color: var(--dark);
            min-height: 100vh;
        }

        /* Navigation - Consistent with main page */
        .navbar {
            background: rgba(108, 92, 231, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            color: white;
            padding: 15px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .navbar-title {
            margin: 0;
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 1px;
        }

        .back-button {
            color: white;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .back-button:hover {
            color: var(--accent);
            transform: translateX(-3px);
        }

        /* Form Container */
        .form-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-header h2 {
            font-size: 2.2rem;
            color: var(--primary);
            margin-bottom: 10px;
            position: relative;
            display: inline-block;
        }

        .form-header h2::after {
            content: '';
            position: absolute;
            width: 50%;
            height: 4px;
            background: linear-gradient(to right, var(--primary), var(--accent));
            bottom: -10px;
            left: 25%;
            border-radius: 2px;
        }

        .form-header p {
            color: var(--dark);
            opacity: 0.8;
        }

        /* Form Styling */
        .treasure-form {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.2);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        /* File Upload Styling */
        .file-upload {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-upload-btn {
            width: 100%;
            padding: 12px 15px;
            background: var(--light);
            border: 2px dashed #e0e0e0;
            border-radius: 10px;
            text-align: center;
            color: var(--dark);
            cursor: pointer;
            transition: all 0.3s;
        }

        .file-upload-btn:hover {
            background: #f0f0f0;
            border-color: var(--primary);
        }

        .file-upload-input {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-upload-preview {
            margin-top: 15px;
            display: none;
            text-align: center;
        }

        .file-upload-preview img {
            max-width: 200px;
            max-height: 150px;
            border-radius: 8px;
            border: 2px solid #e0e0e0;
        }

        /* Rating Stars */
        .rating-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .star-rating {
            display: flex;
            gap: 5px;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            font-size: 1.8rem;
            color: #e0e0e0;
            cursor: pointer;
            transition: color 0.2s;
        }

        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: var(--warning);
        }

        .star-rating input:checked + label {
            color: var(--warning);
        }

        /* Submit Button */
        .submit-btn {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(108, 92, 231, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(108, 92, 231, 0.4);
        }

        /* Form Grid Layout */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        /* Add to your existing CSS */
        #map {
            width: 100%;
            border: 2px solid #e0e0e0;
            transition: all 0.3s;
        }

        #map:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.2);
        }

        .leaflet-container {
            font-family: 'Poppins', sans-serif;
        }

        .leaflet-control-geocoder-form input {
            font-family: 'Poppins', sans-serif;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-header h2 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
<!-- Navigation Bar -->
<nav class="navbar">
    <h1 class="navbar-title">ExploreLocal</h1>
    <a href="{{route('dashboard')}}" class="back-button">
        <i class="fas fa-arrow-left"></i> Back to Treasures
    </a>
</nav>

<!-- Form Container -->
<div class="form-container animate__animated animate__fadeIn">
    <div class="form-header">
        <h2>Share a New Treasure</h2>
        <p>Help others discover amazing places by adding your favorite spots</p>
    </div>

    <form class="treasure-form" id="addTreasureForm"  action="{{route('addTreasure')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid">
            <div class="form-group">
                <label for="treasureName">Treasure Name*</label>
                <input type="text" id="treasureName" class="form-control" placeholder="e.g. Central Park"  name="treasureName" required>
                @error('treasureName')
                <div style="color: #ffebee; background: var(--danger); padding: 8px; border-radius: 6px; margin-top: 10px; font-size: 0.9rem;">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="treasureLocation">Location*</label>
                <input type="text" id="treasureLocation" class="form-control" placeholder="e.g. New York, NY"  name="treasureLocation" required>
                @error('treasureLocation')
                <div style="color: #ffebee; background: var(--danger); padding: 8px; border-radius: 6px; margin-top: 10px; font-size: 0.9rem;">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="treasureDescription">Description*</label>
            <textarea id="treasureDescription" name="treasureDescription" class="form-control" placeholder="Tell us what makes this place special..." required></textarea>
            @error('treasureDescription')
            <div style="color: #ffebee; background: var(--danger); padding: 8px; border-radius: 6px; margin-top: 10px; font-size: 0.9rem;">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="treasureCategory">Category</label>
                <select id="treasureCategory"  name="treasureCategory" class="form-control">
                    <option value="">Select a category</option>
                    <option value="landmark">Landmark</option>
                    <option value="park">Park</option>
                    <option value="museum">Museum</option>
                    <option value="restaurant">Restaurant</option>
                    <option value="hidden-gem">Hidden Gem</option>
                </select>
                @error('treasureCategory')
                <div style="color: #ffebee; background: var(--danger); padding: 8px; border-radius: 6px; margin-top: 10px; font-size: 0.9rem;">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label>Your Rating*</label>
                <div class="rating-container">
                    <div class="star-rating">
                        <input type="radio" id="star5" name="rating" value="5">
                        <label for="star5">★</label>
                        <input type="radio" id="star4" name="rating" value="4">
                        <label for="star4">★</label>
                        <input type="radio" id="star3" name="rating" value="3">
                        <label for="star3">★</label>
                        <input type="radio" id="star2" name="rating" value="2">
                        <label for="star2">★</label>
                        <input type="radio" id="star1" name="rating" value="1" checked>
                        <label for="star1">★</label>
                    </div>
                    @error('rating')
                    <div style="color: #ffebee; background: var(--danger); padding: 8px; border-radius: 6px; margin-top: 10px; font-size: 0.9rem;">
                        {{ $message }}
                    </div>
                    @enderror
                    <span id="ratingValue">1 stars</span>

                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Upload Photos*</label>
            <div class="file-upload">
                <div class="file-upload-btn" id="uploadBtn">
                    <i class="fas fa-cloud-upload-alt" style="margin-right: 8px;"></i>
                    Click to upload or drag and drop
                </div>
                <input type="file" id="fileInput" name="treasure[]" class="file-upload-input" accept="image/*" multiple required>
                @error('fileInput')
                <div style="color: #ffebee; background: var(--danger); padding: 8px; border-radius: 6px; margin-top: 10px; font-size: 0.9rem;">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="file-upload-preview" id="previewContainer">
                <img id="previewImage" src="" alt="Preview">
                <div id="fileCount"></div>
            </div>
        </div>

        <div class="form-group">
            <label for="treasureTips">Tips & Recommendations</label>
            <textarea id="treasureTips"  name="treasureTips" class="form-control" placeholder="Best time to visit, what to bring, etc."></textarea>
        </div>

        <!-- Add this after your "Tips & Recommendations" textarea -->
        <div class="form-group">
            <label for="locationPicker">Map Location*</label>
            <div id="map" style="height: 300px; border-radius: 10px; margin-bottom: 10px;"></div>
            <div class="form-grid">
                <div class="form-group">
                    <label for="latitude">Latitude</label>
                    <input type="text" id="latitude" name="latitude" class="form-control" readonly required>
                </div>
                <div class="form-group">
                    <label for="longitude">Longitude</label>
                    <input type="text" id="longitude" name="longitude" class="form-control" readonly required>
                </div>
            </div>
            <input type="text" id="locationSearch" class="form-control" placeholder="Search for a location..." style="margin-top: 10px;">
            @error('latitude')
            <div style="color: #ffebee; background: var(--danger); padding: 8px; border-radius: 6px; margin-top: 10px; font-size: 0.9rem;">
                {{ $message }}
            </div>
            @enderror
        </div>

        <button type="submit" class="submit-btn">
            <i class="fas fa-plus-circle" style="margin-right: 8px;"></i>
            Add Treasure
        </button>
    </form>
</div>

<script>
    // Star rating interaction
    const starInputs = document.querySelectorAll('.star-rating input');
    const ratingValue = document.getElementById('ratingValue');

    starInputs.forEach(input => {
        input.addEventListener('change', () => {
            ratingValue.textContent = `${input.value} star${input.value > 1 ? 's' : ''}`;
        });
    });

    // File upload preview
    const fileInput = document.getElementById('fileInput');
    const previewContainer = document.getElementById('previewContainer');
    const previewImage = document.getElementById('previewImage');
    const fileCount = document.getElementById('fileCount');
    const uploadBtn = document.getElementById('uploadBtn');

    fileInput.addEventListener('change', function() {
        if (this.files.length > 0) {
            if (this.files.length === 1) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';
                    fileCount.textContent = '';
                }
                reader.readAsDataURL(this.files[0]);
            } else {
                previewImage.src = '';
                previewContainer.style.display = 'block';
                fileCount.textContent = `${this.files.length} files selected`;
            }
            uploadBtn.innerHTML = `<i class="fas fa-check-circle" style="margin-right: 8px; color: var(--success);"></i> ${this.files.length} file${this.files.length > 1 ? 's' : ''} selected`;
            uploadBtn.style.borderColor = 'var(--success)';
        }
    });

    // Form submission
    // document.getElementById('addTreasureForm').addEventListener('submit', function(e) {
    //     e.preventDefault();
    //     // Here you would normally handle form submission to your backend
    //     alert('Treasure added successfully! Redirecting...');
    //     // window.location.href = 'index.html'; // Redirect after submission
    // });

    const map = L.map('map').setView([20.5937, 78.9629], 5); // Default to India view

    // Add tile layer (OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Add geocoder control
    const geocoder = L.Control.geocoder({
        defaultMarkGeocode: false,
        placeholder: 'Search for a location...',
        errorMessage: 'Location not found.'
    }).addTo(map);

    // Add marker
    let marker;

    // Handle geocoder result
    geocoder.on('markgeocode', function(e) {
        const { center, name } = e.geocode;
        updateLocation(center.lat, center.lng, name);
    });

    // Handle map click
    map.on('click', function(e) {
        // Reverse geocode to get address
        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${e.latlng.lat}&lon=${e.latlng.lng}`)
            .then(response => response.json())
            .then(data => {
                const address = data.display_name || 'Selected location';
                updateLocation(e.latlng.lat, e.latlng.lng, address);
            });
    });

    // Update location fields
    function updateLocation(lat, lng, address) {
        // Remove existing marker
        if (marker) map.removeLayer(marker);

        // Add new marker
        marker = L.marker([lat, lng]).addTo(map)
            .bindPopup(address)
            .openPopup();

        // Set view to marker
        map.setView([lat, lng], 15);

        // Update form fields
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
        document.getElementById('treasureLocation').value = address;
    }

    // Search box functionality
    // document.getElementById('locationSearch').addEventListener('keypress', function(e) {
    //     if (e.key === 'Enter') {
    //         e.preventDefault();
    //         geocoder.geocode(this.value);
    //     }
    // });

    document.getElementById('locationSearch').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const query = this.value;

            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        const lat = data[0].lat;
                        const lon = data[0].lon;

                        document.getElementById('latitude').value = lat;
                        document.getElementById('longitude').value = lon;

                        // Assume you have a Leaflet map initialized as `map`
                        map.setView([lat, lon], 15); // Zoom to location

                        L.marker([lat, lon]).addTo(map)
                            .bindPopup(query)
                            .openPopup();
                    } else {
                        alert('Location not found');
                    }
                })
                .catch(err => console.error(err));
        }
    });
</script>
</body>
</html>
