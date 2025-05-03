
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $treasure->name }} | ExploreLocal</title>

    <!-- Use the same styling as your main page -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

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
        }

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

        .back-button {
            color: white;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .treasure-detail-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .treasure-header {
            display: flex;
            gap: 30px;
            margin-bottom: 40px;
        }

        .gallery-container {
            flex: 1;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .main-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .thumbnail-container {
            display: flex;
            gap: 10px;
            padding: 15px;
            overflow-x: auto;
        }

        .thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s;
        }

        .thumbnail:hover, .thumbnail.active {
            border-color: var(--primary);
            transform: scale(1.05);
        }

        .treasure-info {
            flex: 1;
        }

        .treasure-title {
            font-size: 2.2rem;
            margin-bottom: 10px;
            color: var(--primary);
        }

        .treasure-meta {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            align-items: center;
        }

        .treasure-rating {
            background: var(--warning);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .treasure-category {
            background: var(--accent);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        .treasure-location {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            color: var(--dark);
            font-size: 1.1rem;
        }

        .treasure-description {
            line-height: 1.8;
            margin-bottom: 30px;
            color: var(--dark);
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }

        .action-btn {
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .primary-btn {
            background: var(--primary);
            color: white;
            border: none;
        }

        .primary-btn:hover {
            background: var(--secondary);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(108, 92, 231, 0.3);
        }

        .secondary-btn {
            background: white;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .secondary-btn:hover {
            background: var(--light);
            transform: translateY(-3px);
        }

        .section-title {
            font-size: 1.5rem;
            margin: 30px 0 15px;
            color: var(--dark);
            position: relative;
            padding-bottom: 10px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(to right, var(--primary), var(--accent));
        }

        .treasure-map {
            height: 400px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        .tips-container {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 40px;
        }

        .tip-item {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .tip-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .tip-icon {
            color: var(--primary);
            font-size: 1.2rem;
            margin-top: 3px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .treasure-header {
                flex-direction: column;
            }

            .main-image {
                height: 300px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .treasure-map {
                height: 300px;
            }
        }
    </style>
</head>
<body>
<nav class="navbar">
    <a href="{{ route('dashboard') }}" class="back-button">
        <i class="fas fa-arrow-left"></i> Back to Treasures
    </a>
    <h1>ExploreLocal</h1>
    <div></div> <!-- Empty div for spacing -->
</nav>

<div class="treasure-detail-container animate__animated animate__fadeIn">
    <div class="treasure-header">
        <div class="gallery-container">
            <img src="{{ asset($treasure->cover_image) }}" alt="{{ $treasure->name }}" class="main-image" id="mainImage">
            <div class="thumbnail-container">
                @foreach($treasure->images as $image)
                    <img src="{{ asset($image) }}" class="thumbnail" onclick="document.getElementById('mainImage').src = this.src">
                @endforeach
            </div>
        </div>

        <div class="treasure-info">
            <h1 class="treasure-title">{{ $treasure->name }}</h1>

            <div class="treasure-meta">
                    <span class="treasure-rating">
                        <i class="fas fa-star"></i> {{ $treasure->rating }}/5
                    </span>
                <span class="treasure-category">{{ $treasure->category }}</span>
            </div>

            <div class="treasure-location">
                <i class="fas fa-map-marker-alt" style="color: var(--danger);"></i>
                <span>{{ $treasure->location }}</span>
            </div>

            <p class="treasure-description">
                {{ $treasure->description }}
            </p>

            <div class="action-buttons">
                <button class="action-btn primary-btn" onclick="openDirections({{ $treasure->latitude }}, {{ $treasure->longitude }})">
                    <i class="fas fa-directions"></i> Get Directions
                </button>
                <button class="action-btn secondary-btn" onclick="shareTreasure()">
                    <i class="fas fa-share-alt"></i> Share
                </button>
            </div>

            <div class="section-title">About This Place</div>
            <p>Additional detailed description about the treasure location, history, and significance...</p>
        </div>
    </div>

    <div class="section-title">Location Map</div>
    <div class="treasure-map" id="treasureMap">
        <!-- Map will be inserted here by JavaScript -->
    </div>

    <div class="section-title">Visitor Tips</div>
    <div class="tips-container">
        @foreach(explode("\n", $treasure->tips_recommendations) as $tip)
            @if(trim($tip))
                <div class="tip-item">
                    <div class="tip-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <div class="tip-text">{{ $tip }}</div>
                </div>
            @endif
        @endforeach
    </div>
</div>

<script>
    // Initialize map
    function initMap() {
        const map = L.map('treasureMap').setView([{{ $treasure->latitude }}, {{ $treasure->longitude }}], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([{{ $treasure->latitude }}, {{ $treasure->longitude }}]).addTo(map)
            .bindPopup("<b>{{ $treasure->name }}</b><br>{{ $treasure->location }}")
            .openPopup();
    }

    // Directions function
    function openDirections(lat, lng) {
        window.open(`https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`, '_blank');
    }

    // Share function
    function shareTreasure() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $treasure->name }}',
                text: 'Check out this amazing place I found on ExploreLocal!',
                url: window.location.href
            }).catch(err => {
                console.log('Error sharing:', err);
            });
        } else {
            // Fallback for browsers that don't support Web Share API
            prompt('Copy this link to share:', window.location.href);
        }
    }

    // Initialize map when page loads
    document.addEventListener('DOMContentLoaded', initMap);
</script>

<!-- Leaflet JS for maps -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</body>
</html>
