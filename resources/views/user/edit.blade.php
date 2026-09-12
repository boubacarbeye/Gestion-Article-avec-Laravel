@extends('base')

@section('title', 'Modifier un utilisateur')

@section('content')
<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            <h2>Modifier l'utilisateur</h2>
            <p>Mettez à jour le profil de <strong>{{ $user->name }}</strong> sur <strong>SenArticle</strong></p>
        </div>

        <form action="{{ route('users.update', $user) }}" method="POST" class="auth-form">
            @csrf
            @method('PUT')

            {{-- Champ Nom d'utilisateur --}}
            <div class="form-group">
                <label for="name">Nom d'utilisateur</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $user->name) }}"
                    class="form-control @error('name') is-invalid @enderror"
                    required
                    autofocus
                >
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            {{-- Champ Mot de passe (Optionnel) --}}
            <div class="form-group">
                <label for="password">Nouveau mot de passe</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="••••••••"
                >
                <small class="help-text">Laissez vide si vous ne souhaitez pas modifier le mot de passe.</small>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            {{-- Champ Rôle --}}
            <div class="form-group">
                <label for="role">Rôle</label>
                <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrateur</option>
                    <option value="ecrivain" {{ old('role', $user->role) === 'ecrivain' ? 'selected' : '' }}>Écrivain</option>
                </select>
                @error('role')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Mettre à jour l'utilisateur</button>
        </form>
    </div>
</div>

<style>
    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 2.5rem 1rem;
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .form-card {
        background: #ffffff;
        width: 100%;
        max-width: 480px;
        padding: 2.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e9ecef;
    }

    .form-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .form-header h2 {
        margin: 0 0 0.5rem 0;
        color: #2b2d42;
        font-size: 1.6rem;
        font-weight: 700;
    }

    .form-header p {
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
        background-color: #fff;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .help-text {
        font-size: 0.8rem;
        color: #6c757d;
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
