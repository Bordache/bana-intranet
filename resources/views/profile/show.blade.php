<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="border rounded-lg shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] bg-white max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 py-3">
            <div class="d-flex align-items-center">
                <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center overflow-hidden"
                    style="width: 100px; height: 100px; font-size: 36px; font-weight: bold; flex-shrink: 0;">
                    {{-- @if ($profile->photo)
                        <img src="{{ $profile->photo }}" alt="Photo de profil" class="img-fluid w-100 h-100">
                    @else --}}
                    {{ strtoupper(substr($profile->name, 0, 1)) }}{{ strtoupper(substr($profile->firstname, 0, 1)) }}
                    {{-- @endif --}}
                </div>
                <div class="ms-3">
                    <h5 class="mb-1">{{ $profile->name }} {{ $profile->firstname }}</h5>
                    <p class="text-muted mb-0">{{ $profileRank->rank_name }}</p>
                </div>
            </div>
            <div class="d-flex align-items-start">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active text-start w-max" id="v-pills-informations-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-informations" type="button" role="tab"
                        aria-controls="v-pills-informations" aria-selected="true">Mes informations</button>
                    <button class="nav-link text-start w-max" id="v-pills-files-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-files" type="button" role="tab" aria-controls="v-pills-files"
                        aria-selected="false">Mes fichiers</button>
                    <button class="nav-link text-start w-max" id="v-pills-MilitaryStatus-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-MilitaryStatus" type="button" role="tab"
                        aria-controls="v-pills-MilitaryStatus" aria-selected="false">Mes états de service</button>
                    <button class="nav-link text-start w-max" id="v-pills-settings-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-settings" type="button" role="tab"
                        aria-controls="v-pills-settings" aria-selected="false">Settings</button>
                </div>
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-informations" role="tabpanel"
                        aria-labelledby="v-pills-informations-tab">
                        <ul class="nav nav-tabs text-sm" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link @if (!session('tab')) active
                                            @elseif(session('tab') == 'personnal_information')
                                                active @endif"
                                    id="inform-tab" data-bs-toggle="tab" data-bs-target="#inform" type="button"
                                    role="tab" aria-controls="inform" aria-selected="true">Etat civil</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ session('tab') == 'military_detail' ? 'active' : '' }}"
                                    id="military-tab" data-bs-toggle="tab" data-bs-target="#military" type="button"
                                    role="tab" aria-controls="military" aria-selected="false">Rensignements
                                    militaires</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ session('tab') == 'spouse_details' ? 'active' : '' }}"
                                    id="spouse-tab" data-bs-toggle="tab" data-bs-target="#spouse" type="button"
                                    role="tab" aria-controls="spouse" aria-selected="false">Conjoint(e)</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ session('tab') == 'children_details' ? 'active' : '' }}"
                                    id="child-tab" data-bs-toggle="tab" data-bs-target="#child" type="button"
                                    role="tab" aria-controls="child" aria-selected="false">Enfant(s)</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ session('tab') == 'academic_paths' ? 'active' : '' }}"
                                    id="school-tab" data-bs-toggle="tab" data-bs-target="#school" type="button"
                                    role="tab" aria-controls="school" aria-selected="false">Parcours
                                    académique</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ session('tab') == 'military_paths' ? 'active' : '' }}"
                                    id="formation-tab" data-bs-toggle="tab" data-bs-target="#formation"
                                    type="button" role="tab" aria-controls="formation"
                                    aria-selected="false">Parcours militaire</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ session('tab') == 'professional_careers' ? 'active' : '' }}"
                                    id="career-tab" data-bs-toggle="tab" data-bs-target="#career" type="button"
                                    role="tab" aria-controls="career" aria-selected="false">Parcours
                                    professionnel</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ session('tab') == 'rank_histories' ? 'active' : '' }}"
                                    id="rank-tab" data-bs-toggle="tab" data-bs-target="#rank" type="button"
                                    role="tab" aria-controls="rank" aria-selected="false">Grades
                                    successifs</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link {{ session('tab') == 'honorary_distinctions' ? 'active' : '' }}"
                                    id="award-tab" data-bs-toggle="tab" data-bs-target="#award" type="button"
                                    role="tab" aria-controls="award" aria-selected="false">Distinctions
                                    honorifiques</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ session('tab') == 'campaign_histories' ? 'active' : '' }}"
                                    id="campaign-tab" data-bs-toggle="tab" data-bs-target="#campaign" type="button"
                                    role="tab" aria-controls="campaign" aria-selected="false">Campagnes
                                    militaires</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent" style="margin-top:0.5em;">
                            <div class="tab-pane fade show bg-white @if (!session('tab')) show active @elseif(session('tab') == 'personnal_information') show active @endif"
                                id="inform" role="tabpanel" aria-labelledby="inform-tab">
                                @include('personnel.profile.partials.views.civil-view')
                                @include('personnel.profile.partials.templates.civil-modal')
                            </div>
                            <div class="tab-pane fade bg-white {{ session('tab') == 'military_detail' ? 'show active' : '' }}"
                                id="military" role="tabpanel" aria-labelledby="military-tab">
                                @include('personnel.profile.partials.views.military-view')
                                @include('personnel.profile.partials.templates.military-modal')
                            </div>
                            <div class="tab-pane fade bg-white {{ session('tab') == 'spouse_details' ? 'show active' : '' }}"
                                id="spouse" role="tabpanel" aria-labelledby="spouse-tab">
                                @include('personnel.profile.partials.views.spouse-view')
                                @include('personnel.profile.partials.templates.spouse-modal')
                            </div>
                            <div class="tab-pane fade bg-white {{ session('tab') == 'children_details' ? 'show active' : '' }}"
                                id="child" role="tabpanel" aria-labelledby="child-tab">
                                @include('personnel.profile.partials.views.children-view')
                                @include('personnel.profile.partials.templates.children-modal')
                            </div>
                            <div class="tab-pane fade bg-white {{ session('tab') == 'academic_paths' ? 'show active' : '' }}"
                                id="school" role="tabpanel" aria-labelledby="school-tab">
                                @include('personnel.profile.partials.views.school-view')
                                @include('personnel.profile.partials.templates.school-modal')
                            </div>
                            <div class="tab-pane fade bg-white {{ session('tab') == 'military_paths' ? 'show active' : '' }}"
                                id="formation" role="tabpanel" aria-labelledby="formation-tab">
                                @include('personnel.profile.partials.views.formation-view')
                                @include('personnel.profile.partials.templates.formation-modal')
                            </div>
                            <div class="tab-pane fade bg-white {{ session('tab') == 'professional_careers' ? 'show active' : '' }}"
                                id="career" role="tabpanel" aria-labelledby="career-tab">
                                @include('personnel.profile.partials.views.career-view')
                                @include('personnel.profile.partials.templates.career-modal')
                            </div>
                            <div class="tab-pane fade bg-white {{ session('tab') == 'rank_histories' ? 'show active' : '' }}"
                                id="rank" role="tabpanel" aria-labelledby="rank-tab">
                                @include('personnel.profile.partials.views.rank-view')
                                @include('personnel.profile.partials.templates.rank-modal')
                            </div>
                            <div class="tab-pane fade bg-white {{ session('tab') == 'honorary_distinctions' ? 'show active' : '' }}"
                                id="award" role="tabpanel" aria-labelledby="award-tab">
                                @include('personnel.profile.partials.views.award-view')
                                @include('personnel.profile.partials.templates.award-modal')
                            </div>
                            <div class="tab-pane fade bg-white {{ session('tab') == 'campaign_histories' ? 'show active' : '' }}"
                                id="campaign" role="tabpanel" aria-labelledby="campaign-tab">
                                @include('personnel.profile.partials.views.campaign-view')
                                @include('personnel.profile.partials.templates.campaign-modal')
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="v-pills-files" role="tabpanel"
                        aria-labelledby="v-pills-files-tab">...</div>
                    <div class="tab-pane fade" id="v-pills-MilitaryStatus" role="tabpanel"
                        aria-labelledby="v-pills-MilitaryStatus-tab">...</div>
                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                        aria-labelledby="v-pills-settings-tab">...</div>
                </div>
            </div>


        </div>
    </div>

    <!-- Toast -->
    @if (session('success'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="fas fa-check-circle text-success px-2"></i>
                    <strong class="me-auto">Bravo !</strong>
                    <small>A l'instant</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    @if (@session('warning'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="fas fa-exclamation-circle text-warning px-2"></i>
                    <strong class="me-auto">Attention !</strong>
                    <small>A l'instant</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('warning') }}
                </div>
            </div>
        </div>
        @endsession
        <!-- Script to trigger the toast -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const toastElement = document.getElementById('liveToast');
                const toast = new bootstrap.Toast(toastElement);
                toast.show(); // Automatically display the toast
            });
        </script>
</x-app-layout>
