<x-guest-layout>
    <div class="max-w-md w-full mx-auto bg-white dark:bg-gray-900 shadow-lg rounded-xl p-8 mt-10">
        <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-6">
            {{ __('Reset Password') }}
        </h2>

        <form method="POST" action="{{ route('courier.password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" class="text-gray-700 dark:text-gray-300" />
                <x-text-input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus
                    class="mt-1 block w-full dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100"
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300" />
                <x-text-input id="password" type="password" name="password" required
                    class="mt-1 block w-full dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100"
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 dark:text-gray-300" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required
                    class="mt-1 block w-full dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100"
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex justify-end">
                <x-primary-button class="w-full justify-center">
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
