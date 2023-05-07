<x-layout>
    <x-section title="New conversation">
        <x-form :action="route('conversation.store')">
            <input type="hidden" name="to" value="{{ $to->uuid }}" />
            <p>
                <label>
                    To
                    <input type="text" value="{{ $to->name }}" readonly />
                </label>
            </p>
            <p>
                <label>
                    Message
                    <input type="text" name="message" />
                </label>
            </p>
            <p><button>Send...</button></p>
        </x-form>
        <p><a href="{{ route('conversations.index') }}">Back</a></p>
    </x-section>
</x-layout>
