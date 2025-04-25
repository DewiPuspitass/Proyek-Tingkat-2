<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @include('profile.partials.update-profile-information-form')
            @include('profile.partials.update-password-form')
            <!-- @include('profile.partials.delete-user-form') -->
        </div>
    </div>
</x-app-layout>


