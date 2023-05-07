<x-layout>
    <x-section title="Recipients">
        <ul>
            @foreach($conversation->recipients as $recipient)
                <li>{{ $recipient->name }}</li>
            @endforeach
        </ul>
    </x-section>

    <x-section title="Conversation">
        <ul>
            @foreach($conversation->messages as $message)
                <li>{{ $message->body }} - {{ $message->sender->name }}</li>
            @endforeach
        </ul>
        <form method="post">
            @csrf
            <label>
                Send message
                <input type="text" name="message" />
            </label>
            <button>Send...</button>
        </form>
    </x-section>

    <p><a href="{{ route('conversations.index') }}">Back</a></p>
</x-layout>
