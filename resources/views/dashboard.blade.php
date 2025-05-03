


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treasures in Your Area</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css for subtle animations -->
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
            height: 100vh;
            color: var(--dark);
        }

        .app-container {
            width: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        /* Modern Glassmorphism Navbar */
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
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-title {
            margin: 0;
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 1px;
        }

        .navbar-links {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar-links li {
            margin-left: 30px;
            position: relative;
        }

        .navbar-links a {
            color: white;
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-links a:hover {
            color: var(--accent);
            transform: translateY(-2px);
        }

        .navbar-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: var(--accent);
            transition: width 0.3s;
        }

        .navbar-links a:hover::after {
            width: 100%;
        }

        .user-image {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            margin-left: 25px;
            border: 2px solid white;
            transition: all 0.3s;
            object-fit: cover;
        }

        .user-image:hover {
            transform: scale(1.1);
            border-color: var(--accent);
            box-shadow: 0 0 15px rgba(253, 121, 168, 0.5);
        }

        /* Animated Greeting */
        .greeting {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 30px 20px;
            margin: 20px 5%;
            border-radius: 15px;
            text-align: center;
            color: white;
            font-weight: 600;
            box-shadow: 0 10px 30px rgba(108, 92, 231, 0.3);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.8s;
        }

        .greeting::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            animation: pulse 8s infinite linear;
        }

        .greeting h2 {
            margin: 0;
            font-size: 2rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: relative;
        }

        /* Floating Action Button */
        .fab {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: var(--accent);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 5px 20px rgba(253, 121, 168, 0.4);
            cursor: pointer;
            z-index: 100;
            transition: all 0.3s;
            animation: bounce 2s infinite;
        }

        .fab:hover {
            transform: scale(1.1) rotate(90deg);
            box-shadow: 0 8px 25px rgba(253, 121, 168, 0.6);
        }

        /* Modern Card Layout for Treasures */
        .location-section {
            margin: 20px 5%;
            padding: 0;
            border-radius: 15px;
            background-color: transparent;
        }

        .location-section h3 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .location-section h3::before {
            content: '';
            display: block;
            width: 30px;
            height: 4px;
            background: linear-gradient(to right, var(--primary), var(--accent));
            border-radius: 2px;
        }

        .treasure-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            padding: 10px 0;
        }

        .treasure-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            position: relative;
        }

        .treasure-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .treasure-image-container {
            height: 180px;
            overflow: hidden;
            position: relative;
        }

        .treasure-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .treasure-card:hover .treasure-image {
            transform: scale(1.1);
        }

        .treasure-details {
            padding: 20px;
        }

        .treasure-details h4 {
            margin: 0 0 10px 0;
            font-size: 1.2rem;
            color: var(--primary);
        }

        .treasure-location {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--dark);
            margin-bottom: 15px;
            font-size: 0.9rem;
        }

        .treasure-location i {
            color: var(--info);
        }

        .stars {
            color: var(--warning);
            font-size: 1rem;
            margin-bottom: 15px;
        }

        .treasure-tag {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--accent);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* Update the FAB styles to work with anchor tag */
        .fab {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: var(--accent);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 5px 20px rgba(253, 121, 168, 0.4);
            cursor: pointer;
            z-index: 100;
            transition: all 0.3s;
            animation: bounce 2s infinite;
            text-decoration: none; /* Remove underline from link */
        }

        .fab:hover {
            transform: scale(1.1) rotate(90deg);
            box-shadow: 0 8px 25px rgba(253, 121, 168, 0.6);
            text-decoration: none; /* Ensure no underline on hover */
            color: white; /* Maintain white color */
        }

        /* If you want to add a tooltip */
        .fab::after {
            content: 'Add New Treasure';
            position: absolute;
            right: 70px;
            white-space: nowrap;
            background: var(--dark);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.8rem;
            opacity: 0;
            transition: opacity 0.3s;
            pointer-events: none;
        }

        .fab:hover::after {
            opacity: 1;
        }

        /* Animations */
        @keyframes pulse {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
            40% {transform: translateY(-20px);}
            60% {transform: translateY(-10px);}
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 15px;
            }

            .navbar-title {
                margin-bottom: 15px;
            }

            .navbar-links {
                width: 100%;
                justify-content: space-around;
            }

            .navbar-links li {
                margin-left: 0;
            }

            .treasure-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <style>
        .treasure-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .action-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
        }

        .directions-btn {
            background: var(--primary);
            color: white;
        }

        .directions-btn:hover {
            background: var(--secondary);
            transform: translateY(-2px);
        }

        .details-btn {
            background: var(--light);
            color: var(--dark);
            border: 1px solid #e0e0e0;
        }

        .details-btn:hover {
            background: #f0f0f0;
            transform: translateY(-2px);
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .treasure-actions {
                flex-direction: column;
                gap: 8px;
            }

            .action-btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="app-container">

    <!-- Modern Glassmorphism Navigation Bar -->
    <nav class="navbar">
        <h1 class="navbar-title animate__animated animate__fadeInLeft">ExploreLocal</h1>
        <ul class="navbar-links">
            <li><a href="#home"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="#about"><i class="fas fa-info-circle"></i> About</a></li>
            <li><a href="#services"><i class="fas fa-concierge-bell"></i> Services</a></li>
            <li><a href="#contact"><i class="fas fa-envelope"></i> Contact</a></li>
        </ul>
        <a href="{{ route('user-profile', ['id' => Auth::user()->id]) }}" class="animate__animated animate__fadeInRight">
            <img src="{{ asset(Auth::user()->profile_image) }}" alt="User" class="user-image" />
        </a>
    </nav>

    <!-- Animated Greeting Message -->
    <div class="greeting">
        <h2>Hello {{ Auth::user()->name ?? 'Guest' }}!</h2>
        <p style="margin-top: 10px; font-weight: 300;">Discover amazing places around you</p>
    </div>

    <!-- Treasures in Your Area - Card Grid Layout -->
    <div class="location-section">
        <h3><i class="fas fa-map-marked-alt"></i> Treasures in Your Area</h3>
        <div class="treasure-grid">


            @php
                $treasures = [
                    ['image' => 'central-park.jpg', 'name' => 'Central Park', 'location' => 'New York, NY', 'stars' => 5, 'tag' => 'Popular'],
                    ['image' => 'metropolitan-museum.jpg', 'name' => 'Metropolitan Museum of Art', 'location' => 'New York, NY', 'stars' => 4, 'tag' => 'Cultural'],
                    ['image' => 'statue-of-liberty.jpg', 'name' => 'Statue of Liberty', 'location' => 'New York, NY', 'stars' => 5, 'tag' => 'Iconic'],
                    ['image' => 'times-square.jpg', 'name' => 'Times Square', 'location' => 'New York, NY', 'stars' => 5, 'tag' => 'Must-see'],
                    ['image' => 'brooklyn-bridge.jpg', 'name' => 'Brooklyn Bridge', 'location' => 'New York, NY', 'stars' => 4, 'tag' => 'Scenic'],
                ];
            @endphp

            @foreach($result as $item)
                <div class="treasure-card animate__animated animate__fadeInUp" style="animation-delay: {{ $loop->index * 0.1 }}s">
                    <div class="treasure-image-container">
                        <img src="{{ asset($item['cover_image']) }}" alt="{{ $item['name'] }}" class="treasure-image" />
                        <span class="treasure-tag">{{ $item['category'] }}</span>
                    </div>

                    <div class="treasure-details">
                        <h4>{{ $item['name'] }}</h4>
                        <div class="treasure-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $item['location'] }}</span>
                        </div>
                        <div class="stars">
                            {{ str_repeat('★', $item['rating']) }}{{ str_repeat('☆', 5 - $item['rating']) }}
                        </div>

                        <div class="treasure-actions">
                            <button class="action-btn directions-btn"
                                    onclick="openDirections('{{ $item['latitude'] }}', '{{ $item['longitude'] }}')">
                                <i class="fas fa-directions"></i> Directions
                            </button>
                            <button class="action-btn details-btn"
                                    onclick="window.location.href='{{ route('treasureDetails', $item['id']) }}'">
                                <i class="fas fa-info-circle"></i> Details
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!-- Floating Action Button -->
    <!-- Replace the existing FAB with this anchored version -->
    <a href="{{route('add_treasures')}}" class="fab animate__animated animate__fadeInUp">
        <i class="fas fa-plus"></i>
    </a>
</div>

<script>
    // Simple animation trigger for demonstration
    // document.querySelector('.fab').addEventListener('click', function() {
    //     alert('This could open a search or add new location feature!');
    // });
</script>

<script>
    // Robust directions function with error handling
    function openDirections(lat, lng) {
        try {
            // Convert to numbers to ensure valid coordinates
            const latitude = parseFloat(lat);
            const longitude = parseFloat(lng);

            if (isNaN(latitude) || isNaN(longitude)) {
                throw new Error('Invalid coordinates');
            }

            // Open in Google Maps
            const url = `https://www.google.com/maps/dir/?api=1&destination=${latitude},${longitude}`;
            window.open(url, '_blank');

        } catch (error) {
            console.error('Error opening directions:', error);
            alert('Could not open directions. Please try again later.');
        }
    }
</script>
</body>
</html>
