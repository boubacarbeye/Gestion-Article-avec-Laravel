@extends('base')

@section('title', 'Modifier l\'article')

@section('content')
<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            <h2>Modifier l'article</h2>
            <p>Mettez à jour les informations de votre article sur <strong>SenArticle</strong></p>
        </div>

        <form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="auth-form">
            @csrf
            @method('PUT')

            {{-- Champ Titre --}}
            <div class="form-group">
                <label for="titre">Titre de l'article</label>
                <input
                    type="text"
                    name="titre"
                    id="titre"
                    value="{{ old('titre', $article->titre) }}"
                    class="form-control @error('titre') is-invalid @enderror"
                    required
                    autofocus
                >
                @error('titre')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            {{-- Champ Contenu --}}
            <div class="form-group">
                <label for="contenu">Contenu</label>
                <textarea
                    name="contenu"
                    id="contenu"
                    rows="6"
                    class="form-control @error('contenu') is-invalid @enderror"
                    required
                >{{ old('contenu', $article->contenu) }}</textarea>
                @error('contenu')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            {{-- Champ Image actuelle + Remplacement --}}
            <div class="form-group">
                <label for="image">Image de couverture</label>

                @if($article->image)
                    <div class="current-image-preview">
                        <p class="preview-label">Image actuelle :</p>
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->titre }}" class="image-thumbnail">
                    </div>
                @endif

                <input
                    type="file"
                    name="image"
                    id="image"
                    class="form-control file-input @error('image') is-invalid @enderror"
                    accept="image/*"
                >
                <small class="help-text">Laissez vide si vous souhaitez conserver l'image actuelle.</small>

                @error('image')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Enregistrer les modifications</button>
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
        max-width: 600px;
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
        font-family: inherit;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    .file-input {
        padding: 0.5rem;
        background-color: #f8f9fa;
        cursor: pointer;
    }

    .current-image-preview {
        margin-bottom: 0.5rem;
    }

    .preview-label {
        font-size: 0.85rem;
        color: #6c757d;
        margin: 0 0 0.4rem 0;
    }

    .image-thumbnail {
        max-width: 150px;
        height: auto;
        border-radius: 6px;
        border: 1px solid #dee2e6;
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
