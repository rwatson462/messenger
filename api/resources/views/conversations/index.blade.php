<x-layout>
    <x-section title="Your conversations">
        <ul>
            @foreach($conversations as $conversation)
                <li>
                    <a href="{{ route('conversation.show', ['conversation' => $conversation->uuid]) }}">
                        {{ $conversation->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </x-section>

    <x-section title="Users">
        <ul>
            @foreach($users as $user)
                <li>
                    {{ $user->name }}
                    @if(!$user->uuid->equals(auth()->user()->uuid))
                        (<a href="{{ route('conversation.new', ['to' => $user->uuid->toString()]) }}">Send message</a>)
                    @endif
                </li>
            @endforeach
        </ul>
    </x-section>
</x-layout>
