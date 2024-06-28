<!-- views/user/profile/edit.php -->
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Profile</h1>
    <form action="/user/profile/update" method="post" onsubmit="return validateForm()">
        <div class="mb-4">
            <label for="profile_image" class="block text-gray-700">Profile Image</label>
            <input type="file" name="profile_image" id="profile_image" class="block w-full mt-2 p-2 border rounded" accept="image/*" onchange="uploadProfileImage(this)">
            <?php if ($profile['profile_image']): ?>
                <img id="profile_image_preview" src="<?php echo $profile['profile_image']; ?>" alt="Profile Image" class="w-32 h-32 rounded-full mt-2">
                <input type="hidden" name="existing_image" id="existing_image" value="<?php echo $profile['profile_image']; ?>">
            <?php else: ?>
                <img id="profile_image_preview" src="#" alt="Profile Image" class="w-32 h-32 rounded-full mt-2" style="display: none;">
                <input type="hidden" name="existing_image" id="existing_image" value="">
            <?php endif; ?>
        </div>
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="block w-full mt-2 p-2 border rounded" value="<?php echo $profile['name']; ?>" required>
        </div>
        <div class="mb-4">
            <label for="surname" class="block text-gray-700">Surname</label>
            <input type="text" name="surname" id="surname" class="block w-full mt-2 p-2 border rounded" value="<?php echo $profile['surname']; ?>" required>
        </div>
        <div class="mb-4">
            <label for="birth_date" class="block text-gray-700">Birth Date</label>
            <input type="date" name="birth_date" id="birth_date" class="block w-full mt-2 p-2 border rounded" value="<?php echo $profile['birth_date']; ?>" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="block w-full mt-2 p-2 border rounded" value="<?php echo $profile['email']; ?>" required>
        </div>
        <div class="mb-4">
            <label for="phone" class="block text-gray-700">Phone</label>
            <input type="tel" name="phone" id="phone" class="block w-full mt-2 p-2 border rounded" value="<?php echo $profile['phone']; ?>" required>
        </div>
        <div class="mb-4">
            <label for="is_verified" class="block text-gray-700">Is Verified</label>
            <input type="checkbox" name="is_verified" id="is_verified" class="mt-2" <?php echo $profile['is_verified'] ? 'checked' : ''; ?>>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Profile</button>
    </form>
</div>

<script>
    function validateForm() {
        var email = document.getElementById('email').value;
        var phone = document.getElementById('phone').value;
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        var phonePattern = /^\+[1-9]\d{1,14}$/;

        if (!emailPattern.test(email)) {
            alert('Please enter a valid email address.');
            return false;
        }

        if (!phonePattern.test(phone)) {
            alert('Please enter a valid phone number.');
            return false;
        }

        return true;
    }

    function uploadProfileImage(input) {
        var formData = new FormData();
        formData.append('profile_image', input.files[0]);

        fetch('/user/profile/uploadImage', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                document.getElementById('profile_image_preview').src = data.imagePath;
                document.getElementById('profile_image_preview').style.display = 'block';
                document.getElementById('existing_image').value = data.imagePath;
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error uploading image:', error);
        });
    }
</script>
