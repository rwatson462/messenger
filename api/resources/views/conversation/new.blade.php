<x-layout>
    <form method="post">
        @csrf
        <label>
            Title
            <input type="text" name="title" />
        </label>
        <button>Create</button>
    </form>
</x-layout>
