<x-layout>
    <x-section title="Conversations">
        <ul>
            @foreach($conversations as $conversation)
                <li>
                    <a href="{{ route('conversation.show', ['conversation' => $conversation->uuid]) }}">
                        {{ $conversation->title }}
                    </a>
                </li>
            @endforeach
        </ul>
        <p><a href="{{ route('conversation.new') }}">New conversation</a></p>
    </x-section>

    <x-section title="Users">
        <ul>
            @foreach($users as $user)
                <li>{{ $user->name }}</li>
            @endforeach
        </ul>
    </x-section>
</x-layout>
