<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-500 hover:text-black leading-tight">
            <a href="{{ route('personnel.index') }}">{{ __('Ressources humaines') }}</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div id="multi-step-form" class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Ajout de nouveau personnel') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Veuillez renseigner toutes les informations concernant le nouveau profil afin de garantir une bonne performance de la plateforme.") }}<br>
                                {{ __("Les champs avec un astérisque (*) sont obligatoires.") }}
                            </p>

                        </p>
                    </header>
                </div>
            </div>
            <!-- Étape 1 : Etat civil -->
            <div class="step p-4 sm:p-8 bg-white shadow sm:rounded-lg" data-step="1">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('personnel.store') }}">
                    @csrf
                    @include('personnel.profile.partials.essai')
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

{{-- <script>
    function nextStep(step) {
        document.querySelectorAll('.step').forEach(el => el.style.display = 'none');
        document.querySelector(`[data-step="${step}"]`).style.display = 'block';
    }

    function previousStep(step) {
        nextStep(step);
    }

    function cancel() {
        window.location.href = "{{ route('personnel.index') }}";
    }

    function submitForm() {
        document.getElementById('multi-step-form').submit();
    }

    function skip() {
        nextStep(document.querySelector('.step[style="display: block;"]').dataset.step + 1);
    }
</script> --}}
