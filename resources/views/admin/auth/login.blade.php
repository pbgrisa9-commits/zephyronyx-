<x-guest-layout>
    <div class="mb-4 text-center">
        <h1 class="text-xl font-bold text-gray-800">Login Admin</h1>
        <p class="text-s text-gray-500">ZEPHYRONYX SPACE</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    @if ($errors->any())
        <div class="mb-4 text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login.store') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Login sebagai admin') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>