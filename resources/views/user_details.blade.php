<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile | ExploreLocal</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
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
            --glass: rgba(255, 255, 255, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            min-height: 100vh;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Main Container */
        .profile-container {
            width: 100%;
            max-width: 1000px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            animation: fadeInUp 0.6s;
        }

        /* Sidebar with Glassmorphism Effect */
        .profile-sidebar {
            flex: 0 0 350px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 40px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .profile-sidebar::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, var(--glass) 0%, rgba(255,255,255,0) 70%);
            animation: pulse 15s infinite linear;
        }

        /* Profile Picture Section */
        .profile-pic-container {
            position: relative;
            z-index: 2;
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-pic-wrapper {
            width: 180px;
            height: 180px;
            margin: 0 auto 20px;
            position: relative;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transition: all 0.3s;
        }

        .profile-pic-wrapper:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .profile-pic {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .change-photo-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: white;
            color: var(--primary);
            border: none;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .change-photo-btn:hover {
            background: var(--accent);
            color: white;
            transform: translateY(-3px);
        }

        /* User Stats */
        .user-stats {
            background: var(--glass);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            margin-top: 40px;
            position: relative;
            z-index: 2;
        }

        .stat-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .stat-item:last-child {
            margin-bottom: 0;
        }

        .stat-label {
            font-weight: 400;
            opacity: 0.8;
        }

        .stat-value {
            font-weight: 600;
        }

        /* Main Content Area */
        .profile-content {
            flex: 1;
            padding: 40px;
            position: relative;
        }

        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .profile-title {
            font-size: 1.8rem;
            color: var(--dark);
            font-weight: 700;
            position: relative;
        }

        .profile-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -8px;
            width: 60px;
            height: 4px;
            background: linear-gradient(to right, var(--primary), var(--accent));
            border-radius: 2px;
        }

        /* Form Styles */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: var(--dark);
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 14px 20px;
            border: 2px solid #e0e4e8;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s;
            background-color: var(--light);
        }

        .form-control:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.2);
            background-color: white;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        /* Form Footer Buttons */
        .form-footer {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .btn {
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            min-width: 140px;
            text-align: center;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 5px 20px rgba(108, 92, 231, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(108, 92, 231, 0.4);
        }

        .btn-outline {
            background: transparent;
            color: var(--dark);
            border: 2px solid #e0e4e8;
        }

        .btn-outline:hover {
            background: #f8f9fa;
            border-color: var(--dark);
        }

        /* Rank Badge */
        .rank-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, var(--warning), #e67e22);
            color: white;
            padding: 6px 15px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Animations */
        @keyframes pulse {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 900px) {
            .profile-container {
                flex-direction: column;
            }

            .profile-sidebar {
                flex: 0 0 auto;
                padding: 30px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full-width {
                grid-column: span 1;
            }
        }

        @media (max-width: 576px) {
            .profile-pic-wrapper {
                width: 140px;
                height: 140px;
            }

            .form-footer {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="profile-container">
    <!-- Profile Sidebar -->
    <div class="profile-sidebar">
        <form id="profilePictureForm" method="POST" action="{{ route('profile-update-picture') }}" enctype="multipart/form-data">
            @csrf
            <div class="profile-pic-container">
                <label for="profileUpload" style="cursor: pointer;">
                    <div class="profile-pic-wrapper">
                        <img src="{{ $user->profile_image ? asset($user->profile_image) : 'https://randomuser.me/api/portraits/women/42.jpg' }}"
                             alt="Profile Picture"
                             class="profile-pic"
                             id="editProfilePic">
                    </div>
                </label>

                <input type="file" id="profileUpload" name="profile_picture" accept="image/*" style="display: none;">
                @error('profile_picture')
                <div style="color: #ffebee; background: var(--danger); padding: 8px; border-radius: 6px; margin-top: 10px; font-size: 0.9rem;">
                    {{ $message }}
                </div>
                @enderror
                <button type="button" class="change-photo-btn" id="editPhotoBtn" onclick="document.getElementById('profileUpload').click()">
                    <i class="fas fa-camera"></i> Change Photo
                </button>
            </div>
        </form>

        <div class="user-stats">
            <div class="stat-item">
                <span class="stat-label">Member Since</span>
                <span class="stat-value">{{ $user->created_at->format('M Y') }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Treasures Shared</span>
                <span class="stat-value">12</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Community Rating</span>
                <span class="stat-value">4.8 ★</span>
            </div>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="profile-content">
        <form action="{{ route('update_profile_details') }}" method="POST">
            <div class="profile-header">
                <h1 class="profile-title">Edit Profile</h1>
                <span class="rank-badge">
                    <i class="fas fa-trophy"></i>
                    Rank {{ $user->rank }}
                </span>
            </div>

            <div class="form-grid">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" id="full_name" class="form-control" name="full_name" value="{{ $user->full_name }}">
                    @error('full_name')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="name" class="form-control" name="name" value="{{ $user->name }}">
                    @error('name')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group full-width">
                    <label for="bio" class="form-label">Bio</label>
                    <textarea id="bio" name="bio" class="form-control" placeholder="Tell the community about yourself...">{{ $user->bio }}</textarea>
                    @error('bio')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" disabled>
                </div>

                <div class="form-group">
                    <label class="form-label">Account Status</label>
                    <div style="padding: 14px 20px; background: #e3f2fd; border-radius: 12px; color: var(--info); font-weight: 500;">
                        <i class="fas fa-check-circle"></i> Verified Account
                    </div>
                </div>
            </div>

            <div class="form-footer">
                <a href="{{ route('user-profile', ['id' => Auth::user()->id]) }}" class="btn btn-outline">
                    <i class="fas fa-times"></i> Cancel
                </a>
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Profile picture upload and preview
    document.getElementById('profileUpload').addEventListener('change', function(e) {
        if (e.target.files[0]) {
            // Show preview
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('editProfilePic').src = event.target.result;
            };
            reader.readAsDataURL(e.target.files[0]);

            // Submit form automatically when file is selected
            const form = document.getElementById('profilePictureForm');
            const formData = new FormData(form);

            // Add AJAX submission
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        // Show success message
                        const successMsg = document.createElement('div');
                        successMsg.style.color = '#e8f5e9';
                        successMsg.style.background = 'var(--success)';
                        successMsg.style.padding = '8px';
                        successMsg.style.borderRadius = '6px';
                        successMsg.style.marginTop = '10px';
                        successMsg.style.fontSize = '0.9rem';
                        successMsg.textContent = 'Profile picture updated successfully!';

                        const container = document.querySelector('.profile-pic-container');
                        const existingMsg = container.querySelector('.error-message');
                        if (existingMsg) {
                            container.removeChild(existingMsg);
                        }
                        container.appendChild(successMsg);

                        setTimeout(() => {
                            container.removeChild(successMsg);
                        }, 3000);
                    } else {
                        console.error('Error updating profile picture');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });

    // Error message styling
    document.querySelectorAll('.error-message').forEach(el => {
        el.style.color = '#ffebee';
        el.style.background = 'var(--danger)';
        el.style.padding = '8px';
        el.style.borderRadius = '6px';
        el.style.marginTop = '10px';
        el.style.fontSize = '0.9rem';
    });
</script>
</body>
</html>
