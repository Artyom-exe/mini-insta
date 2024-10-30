<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Publication Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Affichage de la publication -->
                <div class="mb-4">
                    <img src="{{ Storage::url($publication->image_url) }}" alt="Publication Image"
                        class="w-full h-auto rounded">
                </div>
                <h2 class="text-2xl font-semibold mb-2">{{ $publication->caption }}</h2>
                <p>
                    <a href="{{ route('profile.show', $publication->user->id) }}" class="text-gray-700 mb-4">
                        Posté par : {{ $publication->user->name }}
                    </a>
                </p>
                <p class="text-gray-500">{{ $publication->likes->count() }} likes</p>

                <!-- Bouton Like / Unlike pour la publication -->
                <div class="mt-4">
                    @if (auth()->user()->publiLikes->where('publication_id', $publication->id)->count())
                        <!-- Bouton Unlike si déjà liké -->
                        <form action="{{ route('unlike.publication', $publication->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                Unlike
                            </button>
                        </form>
                    @else
                        <!-- Bouton Like si non liké -->
                        <form action="{{ route('like.publication', $publication->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                Like
                            </button>
                        </form>
                    @endif
                </div>

                <hr class="my-4">

                <!-- Section des commentaires -->
                <h3 class="text-xl font-semibold mb-2">Commentaires</h3>
                @foreach ($publication->comments as $comment)
                    <div class="border-b border-gray-200 mb-2 pb-2">
                        <p>
                            <a href="{{ route('profile.show', $comment->user->id) }}">
                                <strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}
                            </a>
                        </p>
                        <span class="text-gray-500">{{ $comment->likes->count() }} likes</span>

                        <!-- Boutons Like et Unlike pour chaque commentaire -->
                        <div class="flex items-center space-x-2 mt-1">
                            @if (auth()->user()->commentLikes->where('comment_id', $comment->id)->count())
                                <!-- Bouton Unlike si déjà liké -->
                                <form action="{{ route('unlike.comment', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Unlike</button>
                                </form>
                            @else
                                <!-- Bouton Like si non liké -->
                                <form action="{{ route('like.comment', $comment->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-blue-500 hover:underline">Like</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach

                <!-- Formulaire pour ajouter un commentaire -->
                <form action="{{ route('comment.store', $publication->id) }}" method="POST" class="mt-4">
                    @csrf
                    <textarea name="content" rows="3" class="w-full p-2 border border-gray-300 rounded"
                        placeholder="Ajouter un commentaire..."></textarea>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Publier</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
