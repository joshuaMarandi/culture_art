<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Add input fields for profile updates -->
    <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
    <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
    <!-- Add more fields as needed -->
    <button type="submit">Update Profile</button>
</form>
