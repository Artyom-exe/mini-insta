<x-app-layout>
    <div class="max-w-2xl mx-auto mt-8">
        <h1 class="text-2xl font-semibold mb-6">Conversation avec {{ $user->name }}</h1>

        <div class="bg-white shadow-md rounded-lg p-4 mb-4">
            @foreach ($messages as $message)
                <div class="{{ $message->sender_id === auth()->id() ? 'text-right' : 'text-left' }}">
                    <p
                        class="p-2 inline-block mb-2 rounded-lg {{ $message->sender_id === auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800' }}">
                        {{ $message->content }}
                    </p>
                </div>
            @endforeach
        </div>

        <form action="{{ route('messages.send') }}" method="POST" class="flex items-center">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $user->id }}">
            <input type="text" name="message" placeholder="Écrire un message..."
                class="flex-grow p-2 border rounded-l-md" required>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-md">Envoyer</button>
        </form>
    </div>
</x-app-layout>
