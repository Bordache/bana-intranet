<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informations de compte') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Mettez à jour votre profil de compte.") }}
        </p>
    </header>
    <hr class="my-2">

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('myprofile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="firstname" :value="__('Prénoms')" />
            <x-text-input id="firstname" name="firstname" type="text" class="mt-1 block w-full" :value="old('firstname', $user->firstname)" autofocus autocomplete="firstname" />
            <x-input-error class="mt-2" :messages="$errors->get('firstname')" />
        </div>

        <div>
            <x-input-label for="emailshow" :value="__('Email du compte')" />
            <x-text-input id="emailshow" type="text" class="mt-1 block w-full" :value="$user->email" disabled />
        </div>

        <div>
            <x-input-label for="username" :value="__('Identifiant')" />
            <x-text-input id="username"  type="text" class="mt-1 block w-full" :value="$user->username" disabled />
        </div>


        <div>
            <x-text-input id="email" name="email" type="hidden" class="mt-1 block w-full" :value="old('email', $user->email)" />

            {{-- @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif --}}
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
