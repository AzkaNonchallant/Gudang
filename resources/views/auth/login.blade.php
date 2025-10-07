<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-hover: #3a56d4;
            --text-color: #333;
            --light-bg: #f8f9fa;
            --border-radius: 12px;
            --shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        body {
            background-color: var(--light-bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .login-container {
            max-width: 420px;
            width: 100%;
            margin: 0 auto;
        }
        
        .login-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 2.5rem;
            border: none;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .login-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .login-subtitle {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #495057;
        }
        
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
        }
        
        .btn-login {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .register-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .register-link:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }
        
        .alert {
            border-radius: 8px;
            border: none;
            padding: 0.75rem 1rem;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }
        
        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #dee2e6;
        }
        
        .divider-text {
            padding: 0 1rem;
            color: #6c757d;
            font-size: 0.85rem;
        }
        
        @media (max-width: 576px) {
            .login-card {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 login-container">
                <div class="login-card">
                    <div class="login-header">
                        <h2 class="login-title">Welcome Back</h2>
                        <p class="login-subtitle">Sign in to your account to continue</p>
                    </div>

                    @if($errors->any())
                      <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif

                    <form method="POST" action="{{ route('login.post') }}">
                      @csrf
                      <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus placeholder="Enter your email">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required placeholder="Enter your password">
                      </div>
                      <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="remember" id="remember">
                          <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <a href="#" class="text-decoration-none small">Forgot password?</a>
                      </div>
                      <button class="btn btn-primary w-100 btn-login">Sign In</button>
                    </form>

                    <div class="divider">
                        <span class="divider-text">New to our platform?</span>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('register') }}" class="register-link">Create an account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>