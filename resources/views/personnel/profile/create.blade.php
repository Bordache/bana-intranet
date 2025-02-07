<x-app-layout>
    <x-slot name="header">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb"
            class="d-flex justify-content-between align-items-center text-sm">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('personnel.index') }}">Personnel</a></li>
                <li class="breadcrumb-item active" aria-current="page">Base de données</li>
            </ol>
        </nav>
        <h2 class="pt-3 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nouveau profil') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Étape 1 : Etat civil -->
            <form id="personnelForm" method="post" action="{{ route('personnel.store') }}">
                @csrf
                <div class="accordion accordion-flush card" id="accordionFlushExample">
                    <!-- Accordion Item #1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button
                                class="accordion-button"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne"
                                aria-expanded="true"
                                aria-controls="flush-collapseOne">
                                Informations générales
                            </button>
                        </h2>
                        <div id="flush-collapseOne"
                            class="accordion-collapse collapse show"
                            aria-labelledby="flush-headingOne"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                @include('personnel.profile.partials.personnal-informations-create-form')
                            </div>
                        </div>
                    </div>

                    <!-- Accordion Item #2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button
                                class="accordion-button"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseTwo"
                                aria-expanded="true"
                                aria-controls="flush-collapseTwo">
                                Renseignements militaires
                            </button>
                        </h2>
                        <div id="flush-collapseTwo"
                            class="accordion-collapse collapse show"
                            aria-labelledby="flush-headingTwo"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                @include('personnel.profile.partials.military-details-create-form')
                            </div>
                        </div>
                    </div>

                    <!-- Accordion Item #3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingThree">
                            <button
                                class="accordion-button {{ $errors->hasAny([
                                    'spouse_name.*',
                                    'spouse_maiden_name.*',
                                    'spouse_firstname.*',
                                    'spouse_birth_date.*',
                                    'spouse_birth_place.*',
                                    'spouse_profession.*',
                                    'marriage_authorization.*'
                                ]) ? '' : 'collapsed' }}"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseThree"
                                aria-expanded="{{ $errors->hasAny([
                                    'spouse_name.*',
                                    'spouse_maiden_name.*',
                                    'spouse_firstname.*',
                                    'spouse_birth_date.*',
                                    'spouse_birth_place.*',
                                    'spouse_profession.*',
                                    'marriage_authorization.*'
                                ]) ? 'true' : 'false' }}"
                                aria-controls="flush-collapseThree">
                                Renseignements du (de la) conjoint(e)
                            </button>
                        </h2>
                        <div id="flush-collapseThree"
                            class="accordion-collapse collapse {{ $errors->hasAny([
                                'spouse_name.*',
                                'spouse_maiden_name.*',
                                'spouse_firstname.*',
                                'spouse_birth_date.*',
                                'spouse_birth_place.*',
                                'spouse_profession.*',
                                'marriage_authorization.*'
                            ]) ? 'show' : '' }}"
                            aria-labelledby="flush-headingThree"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                @include('personnel.profile.partials.spouse-details-create-form')
                            </div>
                        </div>
                    </div>

                    <!-- Accordion Item #4 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingFour">
                            <button
                                class="accordion-button {{ $errors->hasAny([
                                    'child_full_name.*',
                                    'child_birth_date.*',
                                    'child_birth_place.*',
                                    'child_gender.*',
                                    'child_status.*'
                                ]) ? '' : 'collapsed' }}"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseFour"
                                aria-expanded="{{ $errors->hasAny([
                                    'child_full_name.*',
                                    'child_birth_date.*',
                                    'child_birth_place.*',
                                    'child_gender.*',
                                    'child_status.*'
                                ]) ? 'true' : 'false' }}"
                                aria-controls="flush-collapseFour">
                                Renseignements des enfants
                            </button>
                        </h2>
                        <div id="flush-collapseFour" class="accordion-collapse collapse {{ $errors->hasAny([
                            'child_full_name.*',
                            'child_birth_date.*',
                            'child_birth_place.*',
                            'child_gender.*',
                            'child_status.*'
                        ]) ? 'show' : '' }}" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                @include('personnel.profile.partials.children-details-create-form')
                            </div>
                        </div>
                    </div>

                    <!-- Accordion Item #5 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingFive">
                            <button
                                class="accordion-button {{ $errors->hasAny([
                                    'school_name.*',
                                    'duration.*',
                                    'diploma.*'
                                ]) ? '' : 'collapsed' }}"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseFive"
                                aria-expanded="{{ $errors->hasAny([
                                    'school_name.*',
                                    'duration.*',
                                    'diploma.*'
                                ]) ? 'true' : 'false' }}"
                                aria-controls="flush-collapseFive">
                                Parcours scolaires
                            </button>
                        </h2>
                        <div id="flush-collapseFive" class="accordion-collapse collapse {{ $errors->hasAny([
                            'school_name.*',
                            'duration.*',
                            'diploma.*'
                        ]) ? 'show' : '' }}" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                @include('personnel.profile.partials.academic-paths-create-form')
                            </div>
                        </div>
                    </div>

                    <!-- Accordion Item #6 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingSix">
                            <button
                                class="accordion-button {{ $errors->hasAny([
                                    'academy_name.*',
                                    'academy_duration.*',
                                    'academy_diploma.*'
                                ]) ? '' : 'collapsed' }}"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseSix"
                                aria-expanded="{{ $errors->hasAny([
                                    'academy_name.*',
                                    'academy_duration.*',
                                    'academy_diploma.*'
                                ]) ? 'true' : 'false' }}"
                                aria-controls="flush-collapseSix">
                                Parcours militaires
                            </button>
                        </h2>
                        <div id="flush-collapseSix" class="accordion-collapse collapse {{ $errors->hasAny([
                            'academy_name.*',
                            'academy_duration.*',
                            'academy_diploma.*'
                        ]) ? 'show' : '' }}" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                @include('personnel.profile.partials.military-paths-create-form')
                            </div>
                        </div>
                    </div>

                    <!-- Accordion Item #7 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingSeven">
                            <button
                                class="accordion-button {{ $errors->hasAny([
                                    'company_name.*',
                                    'job_title.*',
                                    'start_date.*',
                                    'end_date.*',
                                    'description.*'
                                ]) ? '' : 'collapsed' }}"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseSeven"
                                aria-expanded="{{ $errors->hasAny([
                                    'company_name.*',
                                    'job_title.*',
                                    'start_date.*',
                                    'end_date.*',
                                    'description.*'
                                ]) ? 'true' : 'false' }}"
                                aria-controls="flush-collapseSeven">
                                Parcours professionnels
                            </button>
                        </h2>
                        <div id="flush-collapseSeven" class="accordion-collapse collapse {{ $errors->hasAny([
                            'company_name.*',
                            'job_title.*',
                            'start_date.*',
                            'end_date.*',
                            'description.*'
                        ]) ? 'show' : '' }}" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                @include('personnel.profile.partials.professional-careers-create-form')
                            </div>
                        </div>
                    </div>

                    <!-- Accordion Item #8 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingEight">
                            <button
                                class="accordion-button {{ $errors->hasAny([
                                    'history_rank.*',
                                    'history_promotion_date.*',
                                    'history_rank_reference.*'
                                ]) ? '' : 'collapsed' }}"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseEight"
                                aria-expanded="{{ $errors->hasAny([
                                    'history_rank.*',
                                    'history_promotion_date.*',
                                    'history_rank_reference.*'
                                ]) ? 'true' : 'false' }}"
                                aria-controls="flush-collapseEight">
                                Grades successifs
                            </button>
                        </h2>
                        <div id="flush-collapseEight" class="accordion-collapse collapse {{ $errors->hasAny([
                            'history_rank.*',
                            'history_promotion_date.*',
                            'history_rank_reference.*'
                        ]) ? 'show' : '' }}" aria-labelledby="flush-headingEight" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                @include('personnel.profile.partials.rank-histories-create-form')
                            </div>
                        </div>
                    </div>

                    <!-- Accordion Item #9 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingNine">
                            <button
                                class="accordion-button {{ $errors->hasAny([
                                    'honorary_title.*',
                                    'honorary_promotion.*',
                                    'honorary_reference.*'
                                ]) ? '' : 'collapsed' }}"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseNine"
                                aria-expanded="{{ $errors->hasAny([
                                    'honorary_title.*',
                                    'honorary_promotion.*',
                                    'honorary_reference.*'
                                ]) ? 'true' : 'false' }}"
                                aria-controls="flush-collapseNine">
                                Décorations successives
                            </button>
                        </h2>
                        <div id="flush-collapseNine" class="accordion-collapse collapse {{ $errors->hasAny([
                            'honorary_title.*',
                            'honorary_promotion.*',
                            'honorary_reference.*'
                        ]) ? 'show' : '' }}" aria-labelledby="flush-headingNine" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                @include('personnel.profile.partials.honorary-distinctions-create-form')
                            </div>
                        </div>
                    </div>

                    <!-- Accordion Item #10 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTen">
                            <button
                                class="accordion-button {{ $errors->hasAny([
                                    'campaign_title.*',
                                    'campaign_period.*',
                                    'campaign_locations.*'
                                ]) ? '' : 'collapsed' }}"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseTen"
                                aria-expanded="{{ $errors->hasAny([
                                    'campaign_title.*',
                                    'campaign_period.*',
                                    'campaign_locations.*'
                                ]) ? 'true' : 'false' }}"
                                aria-controls="flush-collapseTen">
                                Campagnes militaires
                            </button>
                        </h2>
                        <div id="flush-collapseTen" class="accordion-collapse collapse {{ $errors->hasAny([
                            'campaign_title.*',
                            'campaign_period.*',
                            'campaign_locations.*'
                        ]) ? 'show' : '' }}" aria-labelledby="flush-headingTen" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                @include('personnel.profile.partials.military-campaigns-create-form')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center p-4">
                    <x-primary-button>{{ __('Créer le profil') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>


