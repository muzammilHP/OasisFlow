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

                <h1>Customer Login</h1>
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
            
                <div class="nav-buttons">
                    <a href="{{route('homepage')}}"><button class="login">< Back To Home</button></a>
                    </div>
                </div>
            </nav>
        </header>

    

    <div class="container">
        <h1>Log in as customer</h1>
        <p>Welcome back! Please enter your details.</p>
        <form action="{{ route('customer.authenticate') }}" method="post">
            @csrf
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <div id="email-error" class="error"></div>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button class="btn" type="submit">Sign in</button>
        </form>
        
        <div class="register-section">
            <p class="register-text">Don't have an account?</p>
            <a href="{{ route('customer.signup') }}" class="register-btn">Register Now</a>
        </div>
    </div>

    <script>
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const emailError = document.getElementById('email-error');

        // Function to validate email
        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Add an event listener to the password field
        passwordInput.addEventListener('focus', () => {
            const emailValue = emailInput.value;

            // Check if the email is valid
            if (!validateEmail(emailValue)) {
                emailError.textContent = 'Please enter a valid email address.';
            } else {
                emailError.textContent = ''; // Clear error if valid
            }
        });
    </script>
</body>

</html>
