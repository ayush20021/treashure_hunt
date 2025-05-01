<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treasures in Your Area</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- Your CSS -->


    @vite(['resources/css/dashboard.css'])
</head>

<style>
    body {
        font-family: 'Poppins', sans-serif; /* Keeping the Poppins font for a fun look */
        margin: 0;
        padding: 0;
        background-color: #fafafa; /* Light grey background color for a soft effect */
        height: 100vh; /* Full height of the viewport */
    }

    .app-container {
        width: 100%; /* Use full width */
        margin: 0; /* Remove margin */
        padding: 20px; /* Padding for the container */
        background: #ffffff; /* White background for the container */
        border-radius: 12px; /* Rounder corners for a friendly look */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Soft shadow for depth */
        overflow: hidden; /* Prevent overflowing content */
    }

    .navbar {
        background-color: #00796b; /* Teal navbar color */
        color: white;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 12px; /* Rounded corners for navbar */
    }

    .navbar-title {
        margin: 0;
        font-weight: 600; /* Bold font weight */
    }

    .navbar-links {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
    }

    .navbar-links li {
        margin-left: 25px; /* Increased margin for aesthetic spacing */
    }

    .navbar-links a {
        color: white;
        text-decoration: none;
        transition: color 0.3s; /* Smooth transition for hover effect */
    }

    .navbar-links a:hover {
        color: #dbf4f7; /* Light cyan color on hover */
    }

    .user-image {
        width: 40px; /* Size of user image */
        height: 40px; /* Size of user image */
        border-radius: 50%; /* Circular image */
        margin-left: 20px; /* Spacing between links and image */
    }

    .greeting {
        background: linear-gradient(135deg, #009688, #00796b); /* Teal gradient background */
        padding: 20px; /* More padding for a spacious look */
        border-radius: 8px; /* Rounded corners for a soft appearance */
        margin: 20px 0; /* Spacing around the greeting */
        text-align: center; /* Center align text */
        color: white; /* White text for good contrast */
        font-weight: 600; /* Use bold font for the greeting */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); /* Subtle shadow for depth */
    }

    .greeting h2 {
        margin: 0; /* Reset margin for the header */
        font-size: 24px; /* Increased font size for better readability */
        text-transform: uppercase; /* Uppercase letters for style */
        letter-spacing: 1px; /* Slight letter spacing for elegance */
    }

    .location-section {
        margin-top: 20px; /* Spacing above location section */
        max-height: calc(100vh - 200px); /* Set max height to allow scrolling */
        overflow-y: auto; /* Enable vertical scrolling for this section */
        padding: 20px; /* Padding for internal spacing */
        border-radius: 8px; /* Rounded corners */
        background-color: #f1f1f1; /* Light grey background for the section */
    }

    .location-list {
        max-height: 350px; /* Set a max height for the list */
        overflow-y: auto; /* Enable vertical scrolling */
    }

    .treasure-item {
        display: flex; /* Use flexbox for layout */
        align-items: center; /* Align items in the center */
        padding: 15px; /* Padding around each treasure item */
        border-bottom: 1px solid #e0e0e0; /* Light grey separator for each item */
        transition: background 0.2s; /* Transition for hover effect */
    }

    .treasure-item:hover {
        background-color: #e0f2f1; /* Light teal hover effect */
    }

    .treasure-image {
        width: 100px; /* Fixed image width */
        height: 75px; /* Fixed image height */
        object-fit: cover; /* Maintain aspect ratio */
        border-radius: 5px; /* Slightly rounded corners for images */
        margin-right: 15px; /* Space between image and text */
    }

    .treasure-details {
        display: flex; /* Use flexbox for details */
        flex-direction: column; /* Arrange text in a column */
    }

    .treasure-details h4 {
        margin: 0 0 5px 0; /* Spacing for the treasure name */
        color: #4a148c; /* Dark purple for treasure name */
    }

    .stars {
        color: #ffca28; /* Bright yellow for star ratings */
        font-size: 18px; /* Font size for stars */
    }
</style>
<body>
<div class="app-container">

    <!-- Navigation Bar -->
    <nav class="navbar">
        <h1 class="navbar-title">My Funky Website</h1>
        <ul class="navbar-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
        <a href="{{ route('user-profile', ['id' => Auth::user()->id]) }}">
            <img src="{{ asset('storage/'.Auth::user()->profile_image) }}" alt="User" class="user-image" />
        </a>


    </nav>

    <!-- Greeting Message -->
    <div class="greeting">
        <h2>Hello {{ Auth::user()->name ?? 'Guest' }}!</h2>
    </div>

    <!-- Treasures in Your Area -->
    <div class="location-section">
        <h3>Treasures in Your Area:</h3>
        <div class="location-list">

            @php
                $treasures = [
                    ['image' => 'central-park.jpg', 'name' => 'Central Park', 'location' => 'New York, NY', 'stars' => 5],
                    ['image' => 'metropolitan-museum.jpg', 'name' => 'Metropolitan Museum of Art', 'location' => 'New York, NY', 'stars' => 4],
                    ['image' => 'statue-of-liberty.jpg', 'name' => 'Statue of Liberty', 'location' => 'New York, NY', 'stars' => 5],
                    ['image' => 'times-square.jpg', 'name' => 'Times Square', 'location' => 'New York, NY', 'stars' => 5],
                    ['image' => 'brooklyn-bridge.jpg', 'name' => 'Brooklyn Bridge', 'location' => 'New York, NY', 'stars' => 4],
                ];
            @endphp

            @foreach($treasures as $item)
                <div class="treasure-item">
                    <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}" class="treasure-image" />
                    <div class="treasure-details">
                        <h4>{{ $item['name'] }}</h4>
                        <p>Location: {{ $item['location'] }}</p>
                        <p class="stars">{{ str_repeat('⭐', $item['stars']) }}</p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
</body>
</html>
