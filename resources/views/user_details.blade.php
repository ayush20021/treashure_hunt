<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        :root {
            --primary: #2ecc71;
            --primary-dark: #27ae60;
            --primary-light: #58d68d;
            --secondary: #16a085;
            --light: #f8f9fa;
            --dark: #2c3e50;
            --gray: #95a5a6;
            --white: #ffffff;
            --danger: #e74c3c;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: #ecf0f1;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .edit-profile-container {
            display: flex;
            max-width: 900px;
            width: 100%;
            background: var(--white);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .profile-sidebar {
            flex: 0 0 300px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 40px;
            color: var(--white);
            text-align: center;
            position: relative;
        }

        .profile-pic-container {
            margin-bottom: 30px;
        }

        .edit-profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--white);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .edit-profile-pic:hover {
            transform: scale(1.05);
        }

        .change-photo-btn {
            display: inline-block;
            background: var(--white);
            color: var(--primary-dark);
            border: none;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 15px;
        }

        .change-photo-btn:hover {
            background: var(--primary-dark);
            color: var(--white);
        }

        .edit-profile-content {
            flex: 1;
            padding: 40px;
        }

        .edit-profile-title {
            font-size: 1.8rem;
            color: var(--dark);
            margin-bottom: 30px;
            font-weight: 700;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #dfe6e9;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: var(--light);
        }

        .form-control:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(46, 204, 113, 0.2);
            background-color: var(--white);
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .form-footer {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .btn {
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            min-width: 120px;
            text-align: center;
        }

        .btn-primary {
            background: var(--primary);
            color: var(--white);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: var(--dark);
            border: 1px solid var(--gray);
        }

        .btn-outline:hover {
            background: var(--light);
            border-color: var(--dark);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .edit-profile-container {
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

        @media (max-width: 480px) {
            .edit-profile-pic {
                width: 120px;
                height: 120px;
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



<div class="edit-profile-container">
    <div class="profile-sidebar">
        <form id="profilePictureForm" method="POST" action="{{ route('profile-update-picture') }}" enctype="multipart/form-data">
            @csrf
        <div class="profile-pic-container">
            <label for="profileUpload" style="cursor: pointer;">
                <img src="{{ $user->profile_image ? asset('storage/'.$user->profile_image) : 'https://randomuser.me/api/portraits/women/42.jpg' }}"
                     alt="Profile Picture"
                     class="edit-profile-pic"
                     id="editProfilePic"
                >
            </label>

            <input type="file" id="profileUpload" name="profile_picture" accept="image/*" style="display: none;">
            @error('profile_picture')
            <div style="color: red;">{{ $message }}</div>
            @enderror
            <button type="button" class="change-photo-btn" id="editPhotoBtn" onclick="document.getElementById('profileUpload').click()">
                Change Photo
            </button>
        </div>
        </form>
    </div>


    <div class="edit-profile-content">
        <form action="{{ route('update_profile_details') }}" method="POST">
        <h1 class="edit-profile-title">Edit Profile</h1>

        <div class="form-grid">

                @csrf
            <div class="form-group">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" id="full_name" class="form-control"  name = "full_name" value="{{$user->full_name}}">
                @error('full_name')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="name" class="form-control"  name="name"  value="{{$user->name}}">
                @error('name')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group full-width">
                <label for="bio" class="form-label">Bio</label>
                <textarea id="bio"  name="bio" class="form-control">{{$user->bio}}</textarea>
                @error('name')
                <div style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email"  name = "email" class="form-control" value="{{$user->email}}" disabled>
            </div>

            <div class="form-group">
                <label for="rank" class="form-label">Members Rank</label>

                    <input type="email" id="email" class="form-control" value="{{$user->rank}}" disabled>

            </div>

        </div>

            <div class="form-footer">
                <button class="btn btn-outline">Cancel</button>
                <button class="btn btn-primary" type="submit">Save Changes</button>
            </div>
    </form>


    </div>
</div>

<script>
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
                    console.log(data);
                    if(data.success) {
                        // Optional: Show success message
                        console.log('Profile picture updated successfully');
                    } else {
                        console.error('Error updating profile picture');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });
</script>
</body>
</html>
