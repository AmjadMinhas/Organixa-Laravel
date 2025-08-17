<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Organixa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #f8f6f0, #e6ddd0);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(139, 69, 19, 0.1);
            width: 100%;
            max-width: 400px;
            padding: 40px 32px;
        }

        .logo {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo h1 {
            font-size: 28px;
            font-weight: 700;
            color: #8b4513;
            margin-bottom: 8px;
        }

        .logo p {
            color: #8fbc8f;
            font-size: 14px;
            font-style: italic;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #8b4513;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #d2b48c;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #fefefe;
        }

        .form-control:focus {
            outline: none;
            border-color: #8fbc8f;
            box-shadow: 0 0 0 3px rgba(143, 188, 143, 0.1);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
        }

        .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #8fbc8f;
        }

        .checkbox-group label {
            color: #8b4513;
            font-size: 14px;
            margin: 0;
        }

        .submit-btn {
            width: 100%;
            background: linear-gradient(135deg, #8b4513, #8fbc8f);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
        }

        .error-message {
            background: #fee2e2;
            border: 1px solid #f87171;
            color: #dc2626;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 32px 24px;
                margin: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <h1>organixa</h1>
            <p>your space to plan + glow</p>
        </div>

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            @if ($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus
                       placeholder="Enter your email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       required 
                       placeholder="Enter your password">
            </div>

            <div class="checkbox-group">
                <input type="checkbox" 
                       id="remember" 
                       name="remember" 
                       {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">Remember me</label>
            </div>

            <button type="submit" class="submit-btn">
                Sign In
            </button>
        </form>
    </div>
</body>
</html>