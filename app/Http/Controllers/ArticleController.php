<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function index()
    {
        return view('article.index', [
            'articles' => Article::latest()->get()
        ]);
    }

    public function create()
    {
        return view('article.create');
    }

    public function store(StoreArticleRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $data['user_id'] = Auth::id();

        Article::create($data);

        return redirect()->route('articles.index')
            ->with('success', 'L\'article a été créé avec succès !');
    }

    public function edit(Article $article)
    {
        Gate::authorize('update', $article);
        return view('article.edit', compact('article'));
    }

    // Corrigé : $request en premier, puis $article
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $data = $request->validated();

        // On ne gère l'image QUE si l'utilisateur en téléverse une nouvelle
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image du disque si elle existe
            if ($article->image && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }

            // Enregistrer la nouvelle image
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($data);

        return redirect()->route('articles.index')
            ->with('success', 'L\'article a été mis à jour avec succès !');
    }

    public function delete(Article $article)
    {
        // Supprimer l'image associée sur le disque lors de la suppression de l'article
        Gate::authorize('delete', $article);
        if ($article->image && Storage::disk('public')->exists($article->image)) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'L\'article a été supprimé avec succès !');
    }
}
