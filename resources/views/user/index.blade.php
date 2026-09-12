@extends('base')

@section('title', 'Gestion des Utilisateurs')

@section('content')
<div class="users-container">
    <div class="users-header">
        <div>
            <h2>Gestion des Utilisateurs</h2>
            <p>Consultez, modifiez ou supprimez les comptes utilisateurs de <strong>SenArticle</strong></p>
        </div>
        <a href="{{ route('users.create') }}" class="btn-create">+ Nouvel Utilisateur</a>
    </div>

    @if($users->isEmpty())
        <div class="empty-state">
            <p>Aucun utilisateur trouvé.</p>
        </div>
    @else
        <div class="table-card">
            <table class="users-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Rôle</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="user-id">#{{ $user->id }}</td>
                            <td class="user-name">
                                <strong>{{ $user->name }}</strong>
                            </td>
                            <td>
                                <span class="role-badge role-{{ $user->role }}">
                                    {{ ucfirst($user->role ?? 'écrivain') }}
                                </span>
                            </td>
                            <td class="actions-cell">
                                {{-- Bouton Modifier (Pointe vers users.edit) --}}
                                <a href="{{ route('users.edit', $user) }}" class="btn-action btn-edit">
                                    Modifier
                                </a>

                                {{-- Bouton Supprimer (Formulaire DELETE sécurisé) --}}
                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="delete-form" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<style>
    .users-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 2.5rem 1.5rem;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .users-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .users-header h2 {
        margin: 0 0 0.4rem 0;
        color: #2b2d42;
        font-size: 1.8rem;
        font-weight: 700;
    }

    .users-header p {
        margin: 0;
        color: #6c757d;
        font-size: 0.95rem;
    }

    .btn-create {
        background-color: #0d6efd;
        color: #ffffff;
        padding: 0.7rem 1.2rem;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: background-color 0.2s ease;
    }

    .btn-create:hover {
        background-color: #0b5ed7;
    }

    .table-card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #e9ecef;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .users-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .users-table th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #e9ecef;
    }

    .users-table td {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #e9ecef;
        vertical-align: middle;
        font-size: 0.95rem;
        color: #2b2d42;
    }

    .users-table tbody tr:last-child td {
        border-bottom: none;
    }

    .users-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .user-id {
        color: #6c757d;
        font-weight: 600;
        width: 80px;
    }

    .role-badge {
        display: inline-block;
        padding: 0.25rem 0.6rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: capitalize;
    }

    .role-admin {
        background-color: #e0cffc;
        color: #59359a;
    }

    .role-ecrivain {
        background-color: #e2e3e5;
        color: #383d41;
    }

    .text-right {
        text-align: right;
    }

    .actions-cell {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 0.5rem;
    }

    .delete-form {
        margin: 0;
        display: inline;
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
        background-color: #f8f9fa;
        color: #495057;
        border: 1px solid #ced4da;
    }

    .btn-edit:hover {
        background-color: #e9ecef;
        color: #2b2d42;
    }

    .btn-delete {
        background-color: #fff5f5;
        color: #dc3545;
        border: 1px solid #fec8c8;
    }

    .btn-delete:hover {
        background-color: #dc3545;
        color: #ffffff;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #e9ecef;
        color: #6c757d;
    }
</style>
@endsection
