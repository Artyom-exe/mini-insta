<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold mb-6">Conversations</h1>

        <div class="bg-white shadow-sm rounded-lg p-6">
            @forelse ($conversationUsers as $user)
                <div class="flex items-center justify-between mb-4 p-3 bg-gray-50 rounded-md hover:bg-gray-100">
                    <div class="flex items-center">
                        <!-- Affichage de la photo de profil de l'utilisateur de la conversation -->
                        <img src="{{ Storage::url($user->profile_photo) }}" alt="Profile Photo"
                            class="h-12 w-12 rounded-full mr-4">

                        <!-- Lien vers la conversation avec cet utilisateur -->
                        <a href="{{ route('messages.conversation', $user->id) }}"
                            class="text-lg font-semibold text-gray-700">
                            {{ $user->name }}
                        </a>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- Bouton pour accéder à la conversation -->
                        <a href="{{ route('messages.conversation', $user->id) }}" class="text-blue-500 hover:underline">
                            Voir la conversation
                        </a>

                        <!-- Bouton de suppression de la conversation -->
                        <form action="{{ route('messages.delete', $user->id) }}" method="POST"
                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette conversation ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Supprimer</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-600 text-center">Aucune conversation pour le moment.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
