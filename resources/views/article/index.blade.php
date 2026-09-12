@extends('base')

@section('title', 'Les Articles')

@section('content')
<div class="articles-container">
    <div class="articles-header">
        <div>
            <h2>Tous les Articles</h2>
            <p>Découvrez les dernières publications sur <strong>SenArticle</strong></p>
        </div>
        @auth
            <a href="{{ route('articles.create') }}" class="btn-create">+ Créer un article</a>
        @endauth
    </div>

    @if($articles->isEmpty())
        <div class="empty-state">
            <p>Aucun article disponible pour le moment.</p>
        </div>
    @else
        <div class="articles-grid">
            @foreach ($articles as $article)
                <article class="article-card">
                    <div class="card-image-wrapper">
                        @if ($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->titre }}" class="article-img">
                        @else
                            <div class="no-image">Pas d'image</div>
                        @endif
                    </div>

                    <div class="card-body">
                        <div class="author-badge">
                            Par <strong>{{ $article->user->name ?? 'Auteur inconnu' }}</strong>
                        </div>
                        <h3 class="card-title">{{ $article->titre }}</h3>
                        <p class="card-content">{{ Str::limit($article->contenu, 120) }}</p>
                    </div>

                    @auth
                        {{-- Afficher les actions si l'utilisateur est l'auteur OU s'il est Admin --}}
                        @if(auth()->id() === $article->user_id || auth()->user()->role === 'admin')
                            <div class="card-footer">
                                <a href="{{ route('articles.edit', $article) }}" class="btn-action btn-edit">
                                    Modifier
                                </a>

                                <form action="{{ route('articles.delete', $article) }}" method="POST" class="delete-form" onsubmit="return confirm('Voulez-vous vraiment supprimer cet article ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </article>
            @endforeach
        </div>
    @endif
</div>

<style>
    .articles-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2.5rem 1.5rem;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .articles-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2.5rem;
    }

    .articles-header h2 {
        margin: 0 0 0.4rem 0;
        color: #1a202c;
        font-size: 2rem;
        font-weight: 700;
    }

    .articles-header p {
        margin: 0;
        color: #718096;
        font-size: 1rem;
    }

    .btn-create {
        background-color: #2563eb;
        color: #ffffff;
        padding: 0.75rem 1.25rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        transition: background-color 0.2s ease;
        box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);
    }

    .btn-create:hover {
        background-color: #1d4ed8;
    }

    .articles-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
    }

    .article-card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .article-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .card-image-wrapper {
        width: 100%;
        height: 200px;
        background-color: #f1f5f9;
        overflow: hidden;
    }

    .article-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .no-image {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: #94a3b8;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .card-body {
        padding: 1.5rem;
        flex-grow: 1;
    }

    .author-badge {
        font-size: 0.85rem;
        color: #64748b;
        margin-bottom: 0.5rem;
    }

    .card-title {
        margin: 0 0 0.75rem 0;
        color: #0f172a;
        font-size: 1.25rem;
        font-weight: 700;
        line-height: 1.4;
    }

    .card-content {
        margin: 0;
        color: #475569;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .card-footer {
        padding: 1rem 1.5rem;
        background-color: #f8fafc;
        border-top: 1px solid #f1f5f9;
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
    }

    .delete-form {
        margin: 0;
    }

    .btn-action {
        display: inline-block;
        padding: 0.45rem 0.9rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-edit {
        background-color: #ffffff;
        color: #334155;
        border: 1px solid #cbd5e1;
    }

    .btn-edit:hover {
        background-color: #f1f5f9;
        color: #0f172a;
    }

    .btn-delete {
        background-color: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }

    .btn-delete:hover {
        background-color: #dc2626;
        color: #ffffff;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        color: #64748b;
    }
</style>
@endsection
