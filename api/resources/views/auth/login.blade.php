<x-layout>
    <x-section title="Login">
        <p>You must be logged in to play with this app</p>

        <x-form>
            <p>
                <label>
                    Email address
                    <input type="text" name="email" />
                </label>
            </p>
            <p>
                <label>
                    Password
                    <input type="password" name="password" />
                </label>
            </p>
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
            <p><button>Log in...</button></p>
        </x-form>
    </x-section>
</x-layout>
