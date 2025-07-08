<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- <link rel="stylesheet" href="{{asset('css/login.css')}}"> -->
     @vite(['resources/css/login.css', 'resources/js/app.js'])
    <style>
        .error {
            color: red;
            font-size: 0.9em;
        }
        .alert{
            border: 1px solid white;
            padding: 5px;
            color:white;
            border-radius: 5px;
            margin-left:40px;
            background-color: #f44336; /* Red */
            color: white;
            position: relative;
            top: 113px;
        }
    </style>
</head>

<body>

    <header>
            <nav>
                <div class="logo">
                    <img src="{{ asset('images/logo.webp') }}" alt="OasisFlow Logo" class="logo-image">
                </div>
                <h1>Driver Login</h1>
                <div class="nav-buttons">
                    <a href="{{route('homepage')}}"><button class="login">< Back To Home</button></a>
                    </div>
                </div>
            </nav>
        </header>

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    <div class="container">
        <h1>Log in as driver</h1>
        <p>Welcome back! Please enter your details.</p>
        <form action="{{ route('driver.authenticate') }}" method="post">
            @csrf
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <div id="email-error" class="error"></div>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <div id="password-error" class="error"></div>

            <button class="btn" type="submit">Sign in</button>
        </form>
    </div>

    <script>
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const emailError = document.getElementById('email-error');
        const passwordError = document.getElementById('password-error');

        // Validation functions
        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Email regex
            return emailRegex.test(email);
        }

        function validatePassword(password) {
            return password.length >= 6; // Minimum 6 characters
        }

        // Add event listeners for real-time validation
        passwordInput.addEventListener('focus', () => {
            if (!validateEmail(emailInput.value)) {
                emailError.textContent = 'Please enter a valid email address.';
            } else {
                emailError.textContent = ''; // Clear the error
            }
        });

        passwordInput.addEventListener('blur', () => {
            if (!validatePassword(passwordInput.value)) {
                passwordError.textContent = 'Password must be at least 6 characters long.';
            } else {
                passwordError.textContent = ''; // Clear the error
            }
        });
    </script>
</body>

</html>
