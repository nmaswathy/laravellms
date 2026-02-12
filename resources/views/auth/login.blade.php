<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #d9e1e3 0%, #f0fff4 100%);
            min-height: 100vh;
            margin-top: 50px;
        }

        /* Light Mint Green Navbar */
        .navbar-mint-green {
            background: linear-gradient(135deg, #a7f3d0 0%, #86efac 50%, #bbf7d0 100%);
            box-shadow: 0 8px 32px rgba(186, 224, 60, 0.4);
            border-bottom: 1px solid rgba(37, 161, 202, 0.6);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.6rem;
            background: linear-gradient(135deg, #c52fe3, #059669);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .navbar-text {
            background: linear-gradient(135deg, #2438e8, #dd76eb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 600;
            font-size: 2.1rem;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-mint-green fixed-top py-3 mb-4">
        <div class="container-fluid px-4">
            <span class="navbar-brand mb-0">📚 Library Management System</span>
            <span class="navbar-text ms-auto">👨‍💼 Admin Panel</span>
        </div>
    </nav>

    <br><br><br>

    <div class="container m-6 p-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">User Login</h4>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login.post') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter email"
                                    value="{{ old('email') }}" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter password"
                                    required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>