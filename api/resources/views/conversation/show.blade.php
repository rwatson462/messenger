<x-layout>
    <x-section title="Participants">
        <ul>
            @foreach($conversation->participants as $participant)
                <li>
                    {{ $participant->name }}
                    @if ($participant->uuid->equals(auth()->user()->uuid))
                        (you)
                    @endif
                </li>
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
