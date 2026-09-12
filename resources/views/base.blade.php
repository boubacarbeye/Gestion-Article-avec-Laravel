<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'SenArticle - Plateforme d\'actualités')</title>

    <!-- Polices Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --bg-light: #f8fafc;
            --bg-white: #ffffff;
            --border-color: #e2e8f0;
            --danger-color: #ef4444;
            --danger-bg: #fef2f2;
            --admin-badge: #8b5cf6;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            line-height: 1.5;
        }

        /* --- NAVBAR --- */
        .navbar {
            background-color: var(--bg-white);
            border-bottom: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0.85rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            text-decoration: none;
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .brand-icon {
            font-size: 1.4rem;
        }

        .brand-highlight {
            color: var(--primary-color);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            list-style: none;
        }

        .nav-link {
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 500;
            font-size: 0.95rem;
            padding: 0.4rem 0.6rem;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        .nav-link.active {
            color: var(--primary-color);
            font-weight: 600;
        }

        /* --- ADMIN BADGE & LINKS --- */
        .admin-link {
            background-color: #f3e8ff;
            color: var(--admin-badge);
            font-weight: 600;
            font-size: 0.85rem;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            text-decoration: none;
            transition: background 0.2s ease;
        }

        .admin-link:hover {
            background-color: #e9d5ff;
        }

        .user-greeting {
            font-size: 0.9rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* --- BUTTONS --- */
        .inline-form {
            margin: 0;
            display: flex;
            align-items: center;
        }

        .btn {
            padding: 0.5rem 1.1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-login {
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);
        }

        .btn-login:hover {
            background-color: var(--primary-hover);
        }

        .btn-logout {
            background-color: var(--danger-bg);
            color: var(--danger-color);
            border: 1px solid #fecaca;
        }

        .btn-logout:hover {
            background-color: var(--danger-color);
            color: white;
        }

        /* --- MAIN CONTAINER --- */
        .main-container {
            flex: 1;
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            padding: 2rem 1.5rem;
        }

        /* --- FOOTER --- */
        .footer {
            background-color: var(--bg-white);
            border-top: 1px solid var(--border-color);
            padding: 1.5rem 0;
            margin-top: auto;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* --- RESPONSIVE MOBILE --- */
        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 1rem;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
                gap: 0.75rem;
            }
        }
    </style>
</head>
<body>

    <!-- Navigation Header -->
    <header class="navbar">
        <div class="nav-container">
            <!-- Brand Logo & Name -->
            <a href="{{ url('/article') }}" class="nav-brand">
                <span class="brand-icon">🇸🇳</span>
                <span class="brand-name">Sen<span class="brand-highlight">Article</span></span>
            </a>

            <!-- Navigation Links -->
            <ul class="nav-links">
                <li>
                    <a href="{{ route('articles.index') }}" class="nav-link {{ request()->routeIs('articles.*') ? 'active' : '' }}">
                        Articles
                    </a>
                </li>

                <!-- Authenticated User Options -->
                @auth
                    @if(auth()->user()->role === 'admin')
                        <li>
                            <a href="{{ route('users.index') }}" class="admin-link">
                                Gestion Utilisateurs
                            </a>
                        </li>
                    @endif

                    <li>
                        <span class="user-greeting">{{ auth()->user()->name }}</span>
                    </li>

                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="inline-form">
                            @csrf
                            <button type="submit" class="btn btn-logout">Déconnexion</button>
                        </form>
                    </li>
                @endauth

                <!-- Guest User Options -->
                @guest
                    <li>
                        <a href="{{ route('login') }}" class="btn btn-login">Se connecter</a>
                    </li>
                @endguest
            </ul>
        </div>
    </header>

    <!-- Main Content Block -->
    <main class="main-container">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} SenArticle. Tous droits réservés.</p>
    </footer>

</body>
</html>
