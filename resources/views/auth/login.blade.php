@extends('base')

@section('title', 'Connexion')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h2>Connexion</h2>
            <p>Accédez à votre espace d'administration <strong>SenArticle</strong></p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="auth-form">
            @csrf

            <div class="form-group">
                <label for="name">Nom d'utilisateur</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="Ex: moussa_diallo"
                    required
                    autofocus
                >
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="••••••••"
                    required
                >
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Se connecter</button>
        </form>
    </div>
</div>

<style>
    .auth-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 150px);
        padding: 2rem 1rem;
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .auth-card {
        background: #ffffff;
        width: 100%;
        max-width: 420px;
        padding: 2.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e9ecef;
    }

    .auth-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .auth-header h2 {
        margin: 0 0 0.5rem 0;
        color: #2b2d42;
        font-size: 1.75rem;
        font-weight: 700;
    }

    .auth-header p {
        margin: 0;
        color: #6c757d;
        font-size: 0.9rem;
    }

    .auth-form {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .form-group label {
        font-weight: 600;
        font-size: 0.9rem;
        color: #495057;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        border: 1px solid #ced4da;
        border-radius: 6px;
        box-sizing: border-box;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.15);
    }

    .error-message {
        color: #dc3545;
        font-size: 0.825rem;
        font-weight: 500;
    }

    .btn-submit {
        margin-top: 0.5rem;
        padding: 0.85rem;
        background-color: #0d6efd;
        color: #ffffff;
        border: none;
        border-radius: 6px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .btn-submit:hover {
        background-color: #0b5ed7;
    }
</style>
@endsection
