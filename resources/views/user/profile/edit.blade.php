@extends('layouts.user')

@section('title', 'Edit Profile')

@section('content')
<style>
/* Reset dan Base styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background-color: #f0f2f5;
    color: #1a1a1a;
    line-height: 1.6;
    font-family: 'Inter', sans-serif;
}

/* Container utama */
.profile-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    min-height: 100vh;
}

/* Header styles */
.page-header {
    text-align: center;
    margin-bottom: 2rem;
    color: #1a1a1a;
}

/* Card styles */
.profile-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
    max-width: 700px;
    margin: 0 auto 2rem;
    position: relative;
    overflow: visible;
}

.card-header {
    background: #2563eb;
    color: #ffffff;
    padding: 2.5rem 2rem;
    text-align: center;
    height: 200px;
    position: relative;
    border-radius: 20px 20px 0 0;
}

.card-header h4 {
    font-size: 1.75rem;
    font-weight: 600;
    margin: 0;
}

/* Profile photo section */
.profile-photo-section {
    position: relative;
    margin-top: -90px;
    margin-bottom: 2rem;
    text-align: center;
    z-index: 2;
}

.profile-photo-container {
    width: 180px;
    height: 180px;
    margin: 0 auto;
    position: relative;
    border-radius: 50%;
    background: #ffffff;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    overflow: visible;
}

.profile-photo {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    border: 5px solid #ffffff;
    transition: all 0.3s ease;
}

.photo-upload-label {
    position: absolute;
    bottom: 0;
    right: 0;
    background: #2563eb;
    border-radius: 50%;
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    transform: translate(10%, 10%);
    border: 3px solid #ffffff;
    z-index: 3;
}

.photo-upload-label:hover {
    background: #1d4ed8;
    transform: translate(10%, 10%) scale(1.1);
}

.photo-upload-label i {
    color: #ffffff;
    font-size: 1.2rem;
}

/* Form styles */
.profile-form {
    padding: 2rem;
}

.form-grid {
    display: grid;
    grid-gap: 1.5rem;
    margin-bottom: 2rem;
}

.form-group {
    position: relative;
}

.form-label {
    display: block;
    margin-bottom: 0.5rem;
    color: #4b5563;
    font-weight: 500;
    font-size: 0.95rem;
}

.form-control {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 1.5px solid #e5e7eb;
    border-radius: 10px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #ffffff;
}

.form-control:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    outline: none;
}

.form-control.is-invalid {
    border-color: #dc2626;
}

.invalid-feedback {
    color: #dc2626;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

/* Password section styles */
.password-section {
    border-top: 1px solid #e5e7eb;
    margin-top: 2rem;
    padding-top: 2rem;
}

.password-strength {
    margin-top: 0.5rem;
    height: 4px;
    background: #e5e7eb;
    border-radius: 2px;
    overflow: hidden;
}

.password-strength-meter {
    height: 100%;
    width: 0;
    transition: all 0.3s ease;
    border-radius: 2px;
}

.password-requirements {
    margin-top: 0.75rem;
    font-size: 0.875rem;
    color: #6b7280;
}

.requirement-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.25rem;
}

.requirement-item i {
    font-size: 0.75rem;
}

.requirement-met {
    color: #16a34a;
}

/* Button styles */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.875rem 1.5rem;
    border-radius: 10px;
    font-weight: 500;
    transition: all 0.3s ease;
    cursor: pointer;
    border: none;
    gap: 0.5rem;
    font-size: 1rem;
}

.btn-primary {
    background: #2563eb;
    color: #ffffff;
}

.btn-primary:hover {
    background: #1d4ed8;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
}

.btn-block {
    width: 100%;
}

/* Alert styles */
.alert {
    padding: 1rem 1.25rem;
    border-radius: 10px;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 0.95rem;
}

.alert-success {
    background-color: #dcfce7;
    border: 1px solid #bbf7d0;
    color: #166534;
}

.alert-danger {
    background-color: #fee2e2;
    border: 1px solid #fecaca;
    color: #991b1b;
}

/* Quick links card */
.quick-links-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
    max-width: 700px;
    margin: 2rem auto;
    overflow: hidden;
}

.quick-links-header {
    padding: 1.5rem;
    border-bottom: 1px solid #e5e7eb;
}

.quick-links-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
    color: #1a1a1a; /* Dark text for light mode */
    transition: color 0.3s ease; /* Smooth transition for color change */
}

.quick-links-body {
    padding: 1.25rem;
}

.quick-links-grid {
    display: grid;
    grid-gap: 1rem;
}

.quick-link {
    display: flex;
    align-items: center;
    padding: 1rem 1.25rem;
    color: #4b5563;
    text-decoration: none;
    border-radius: 12px;
    transition: all 0.3s ease;
    background: #f8fafc;
}

.quick-link:hover {
    background: #f1f5f9;
    color: #2563eb;
    transform: translateX(5px);
}

.quick-link i {
    margin-right: 0.75rem;
    font-size: 1.25rem;
}

/* Loading states */
.loading {
    position: relative;
    pointer-events: none;
}

.loading::after {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(255, 255, 255, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Notification styles */
.notification {
    position: fixed;
    top: 1rem;
    right: 1rem;
    z-index: 9999;
    padding: 1rem 1.5rem;
    border-radius: 10px;
    background: #ffffff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    max-width: 400px;
    animation: slideIn 0.3s ease;
}

@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

/* Responsive styles */
@media (max-width: 768px) {
    .profile-container {
        padding: 1rem;
    }

    .card-header {
        height: 180px;
        padding: 2rem 1.5rem;
    }

    .profile-form {
        padding: 1.5rem;
    }

    .profile-photo-container {
        width: 160px;
        height: 160px;
    }

    .photo-upload-label {
        width: 40px;
        height: 40px;
    }
}

/* Dark mode */
.dark-mode {
    background: #1a1a1a;
    color: #ffffff;
}

.dark-mode .profile-card,
.dark-mode .quick-links-card {
    background: #2d2d2d;
}

.dark-mode .form-control {
    background: #2d2d2d;
    border-color: #404040;
    color: #ffffff;
}

.dark-mode .quick-link {
    background: #333333;
    color: #e5e7eb;
}

.dark-mode .quick-link:hover {
    background: #404040;
}

.dark-mode .form-label {
    color: #e5e7eb;
}

/* Quick Links Title Styling */
.quick-links-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
    color: #1a1a1a; /* Dark text for light mode */
    transition: color 0.3s ease; /* Smooth transition for color change */
}

.dark-mode .quick-links-title {
    color: #e5e7eb; /* Light text for dark mode */
}

/* Quick Links Card */
.dark-mode .quick-links-card {
    background: #2d2d2d;
}

.dark-mode .quick-links-header {
    border-bottom: 1px solid #404040;
}
</style>

<div class="profile-container">
    <div class="profile-card">
        <div class="card-header">
            <h4>Edit Profile</h4>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            <span>{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            <span>{{ session('error') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="profile-photo-section">
            <div class="profile-photo-container">
                <img src="{{ auth()->user()->profile_photo ? 
                    asset('storage/profile-photos/' . auth()->user()->profile_photo) : 
                    asset('images/default-avatar.png') }}"
                    alt="Profile Photo" 
                    id="photoPreview"
                    class="profile-photo">
                
                <form id="photoForm" action="{{ route('profile.photo.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label class="photo-upload-label" for="profile_photo">
                        <i class="bi bi-camera-fill"></i>
                    </label>
                    <input type="file" 
                           name="profile_photo" 
                           id="profile_photo" 
                           class="d-none"
                           accept="image/*">
                </form>
            </div>
            @error('profile_photo')
            <div class="invalid-feedback d-block text-center mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="profile-form">
            <form action="{{ route('profile.update') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="username">Username</label>
                        <input type="text" 
                               class="form-control @error('username') is-invalid @enderror" 
                               id="username" 
                               name="username" 
                               value="{{ old('username', $user->username) }}" 
                               required>
                        @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $user->name) }}" 
                               required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $user->email) }}" 
                               required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="password-section">
                    <h5 class="section-title mb-4">Change Password</h5>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label" for="old_password">Current Password</label>
                            <input type="password" 
                                   class="form-control @error('old_password') is-invalid @enderror" 
                                   id="old_password" 
                                   name="old_password" 
                                   placeholder="Enter current password">
                            @error('old_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="new_password">New Password</label>
                            <input type="password" 
                                   class="form-control @error('new_password') is-invalid @enderror" 
                                   id="new_password" 
                                   name="new_password" 
                                   placeholder="Enter new password">
                            <div class="password-strength">
                                <div class="password-strength-meter" id="password-strength"></div>
                            </div>
                            <div class="password-requirements mt-2">
                                <div class="requirement-item" id="req-length">
                                    <i class="bi bi-circle"></i>
                                    <span>At least 8 characters</span>
                                </div>
                                <div class="requirement-item" id="req-case">
                                    <i class="bi bi-circle"></i>
                                    <span>Uppercase & lowercase letters</span>
                                </div>
                                <div class="requirement-item" id="req-number">
                                    <i class="bi bi-circle"></i>
                                    <span>At least one number</span>
                                </div>
                                <div class="requirement-item" id="req-special">
                                    <i class="bi bi-circle"></i>
                                    <span>At least one special character</span>
                                </div>
                            </div>
                            @error('new_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="new_password_confirmation">Confirm New Password</label>
                            <input type="password" 
                                   class="form-control" 
                                   id="new_password_confirmation" 
                                   name="new_password_confirmation" 
                                   placeholder="Confirm new password">
                        </div>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="bi bi-check-lg"></i>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="quick-links-card">
        <div class="quick-links-header">
            <h5 class="quick-links-title">Quick Links</h5>
        </div>
        <div class="quick-links-body">
            <div class="quick-links-grid">
                <a href="{{ route('books.purchased') }}" class="quick-link">
                    <i class="bi bi-book"></i>
                    My Books
                </a>
                <a href="{{ route('profile.orders') }}" class="quick-link">
                    <i class="bi bi-bag"></i>
                    My Orders
                </a>
                <a href="{{ route('cart.index') }}" class="quick-link">
                    <i class="bi bi-cart"></i>
                    Cart
                </a>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush

@push('scripts')
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Profile Photo Upload Handler
    const photoInput = document.getElementById('profile_photo');
    const photoPreview = document.getElementById('photoPreview');
    const photoForm = document.getElementById('photoForm');
    
    if (photoInput) {
        photoInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                const file = this.files[0];
                
                // Validasi ukuran file (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    showNotification('Error', 'File terlalu besar. Maksimal ukuran file adalah 2MB', 'error');
                    this.value = '';
                    return;
                }

                // Validasi tipe file
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!allowedTypes.includes(file.type)) {
                    showNotification('Error', 'Tipe file tidak didukung. Gunakan file JPG atau PNG', 'error');
                    this.value = '';
                    return;
                }
                
                reader.onload = function(e) {
                    // Tampilkan preview sementara
                    photoPreview.src = e.target.result;
                    
                    const formData = new FormData(photoForm);
                    
                    // Tampilkan loading state
                    photoPreview.classList.add('loading');
                    
                    fetch(photoForm.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        credentials: 'same-origin'
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // Force browser to reload image from new URL
                            const timestamp = new Date().getTime();
                            photoPreview.src = `${data.photo_url}?t=${timestamp}`;
                            showNotification('Success', 'Profile photo has been updated', 'success');
                        } else {
                            throw new Error(data.message || 'Upload failed');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        photoPreview.src = photoPreview.dataset.originalSrc || '/images/default-avatar.png';
                        showNotification('Error', 'Failed to update photo: ' + error.message, 'error');
                    })
                    .finally(() => {
                        photoPreview.classList.remove('loading');
                    });
                }
                
                reader.readAsDataURL(file);
            }
        });
    }

    // Password Strength Checker
    const newPasswordInput = document.getElementById('new_password');
    const strengthMeter = document.getElementById('password-strength');
    const requirements = {
        length: document.getElementById('req-length'),
        case: document.getElementById('req-case'),
        number: document.getElementById('req-number'),
        special: document.getElementById('req-special')
    };

    function updatePasswordStrength(password) {
        let strength = 0;
        const checks = {
            length: password.length >= 8,
            case: /[a-z]/.test(password) && /[A-Z]/.test(password),
            number: /\d/.test(password),
            special: /[^A-Za-z0-9]/.test(password)
        };

        // Update requirement indicators
        Object.keys(checks).forEach(req => {
            const element = requirements[req];
            if (checks[req]) {
                element.classList.add('requirement-met');
                element.querySelector('i').className = 'bi bi-check-circle-fill';
                strength++;
            } else {
                element.classList.remove('requirement-met');
                element.querySelector('i').className = 'bi bi-circle';
            }
        });

        // Update strength meter
        const width = (strength / 4) * 100;
        strengthMeter.style.width = `${width}%`;
        
        if (strength <= 1) {
            strengthMeter.style.backgroundColor = '#dc3545';
        } else if (strength === 2) {
            strengthMeter.style.backgroundColor = '#ffc107';
        } else if (strength === 3) {
            strengthMeter.style.backgroundColor = '#17a2b8';
        } else {
            strengthMeter.style.backgroundColor = '#28a745';
        }
    }

    if (newPasswordInput) {
        newPasswordInput.addEventListener('input', function() {
            updatePasswordStrength(this.value);
        });
    }

    // Form Validation
    const form = document.querySelector('form.needs-validation');
    if (form) {
        form.addEventListener('submit', function(event) {
            if (!this.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            this.classList.add('was-validated');
        });
    }

    // Notification Function
    function showNotification(title, message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = 'notification ' + (type === 'error' ? 'notification-error' : 'notification-success');
        notification.innerHTML = `
            <i class="bi ${type === 'error' ? 'bi-x-circle' : 'bi-check-circle'} me-2"></i>
            <div>
                <strong>${title}</strong>
                <p class="mb-0">${message}</p>
            </div>
            <button type="button" class="btn-close ms-3" onclick="this.parentElement.remove()"></button>
        `;
        
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.remove();
        }, 5000);
    }
});
</script>
@endpush
@endsection