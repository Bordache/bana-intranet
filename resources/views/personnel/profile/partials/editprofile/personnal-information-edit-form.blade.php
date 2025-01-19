<div class="border border-gray-200 p-3 mb-4">
    <form action="{{ route('personnel.update', $profile->id) }}">
        @csrf
        @method('PUT')
        <div class="d-flex justify-content-between">
            <h3 class="text-lg font-medium text-gray-900">
                {{ __('Etat civil') }}</h3>
        </div>
        <hr class="my-3">
        <div class="row g-3">
            <!-- Gender -->
            <div class="col-md-4 d-flex pt-2">
                <x-input-label for="gender" :value="__('Genre')" />
            </div>
            <div class="col-md-1 d-flex pt-2">
                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Genre" role="img" aria-label="Genre"></i>
            </div>
            <div class="col-md-7">
                <x-select-input id="gender" name="gender">
                    <option value="" {{ $profile->gender == null ? 'selected' : '' }} disabled>{{ __('Choisir à la selection') }}</option>
                    <option value="Masculin" {{ $profile->gender == 'M' ? 'selected' : '' }}>{{ __('Masculin') }}</option>
                    <option value="Féminin" {{ $profile->gender == 'F' ? 'selected' : '' }}>{{ __('Féminin') }}</option>
                </x-select-input>
                <x-input-error class="mt-2" :messages="$errors->get('gender')" />
            </div>

            <!-- Name -->
            <div class="col-md-4 d-flex pt-2">
                <x-input-label for="name" :value="__('Nom')" />
            </div>
            <div class="col-md-1 d-flex pt-2">
                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Nom de naissance" role="img" aria-label="Nom de naissance"></i>
                <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
            </div>
            <div class="col-md-7">
                <x-text-input id="name" name="name" type="text" :value="$profile->name" placeholder="Entrer nom" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <!-- Firstname -->
            <div class="col-md-4 d-flex pt-2">
                <x-input-label for="firstname" :value="__('Prénom(s)')" />
            </div>
            <div class="col-md-1 d-flex pt-2">
                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Prénom(s) de naissance" role="img" aria-label="Prénom(s) de naissance"></i>
            </div>
            <div class="col-md-7">
                <x-text-input id="firstname" name="firstname" type="text" :value="$profile->firstname" placeholder="Entrer prénom(s)" />
                <x-input-error class="mt-2" :messages="$errors->get('firstname')" />
            </div>

            <!-- Birth Date -->
            <div class="col-md-4 d-flex pt-2">
                <x-input-label for="birth_date" :value="__('Date de naissance')" />
            </div>
            <div class="col-md-1 d-flex pt-2">
                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de naissance" role="img" aria-label="Date de naissance"></i>
            </div>
            <div class="col-md-7">
                <x-text-input id="birth_date" name="birth_date" type="date" :value="optional($profile->birth_date)->format('Y-m-d')" />
                <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />
            </div>

            <!-- Birth Place -->
            <div class="col-md-4 d-flex pt-2">
                <x-input-label for="birth_place" :value="__('Lieu de naissance')" />
            </div>
            <div class="col-md-1 d-flex pt-2">
                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu de naissance" role="img" aria-label="Lieu de naissance"></i>
            </div>
            <div class="col-md-7">
                <x-text-input id="birth_place" name="birth_place" type="text" :value="$profile->birth_place" placeholder="Entrer lieu de naissance" />
                <x-input-error class="mt-2" :messages="$errors->get('birth_place')" />
            </div>

            <!-- National ID -->
            <div class="col-md-4 d-flex pt-2">
                <x-input-label for="national_id" :value="__('Numéro d\'identité nationale')" />
            </div>
            <div class="col-md-1 d-flex pt-2">
                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Numéro CIN" role="img" aria-label="Numéro CIN"></i>
                <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
            </div>
            <div class="col-md-7">
                <x-text-input id="national_id" name="national_id" type="number" min="0" :value="$profile->national_id" placeholder="Entrer numéro CIN" />
                <x-input-error class="mt-2" :messages="$errors->get('national_id')" />
            </div>

            <!-- Issue Date -->
            <div class="col-md-4 d-flex pt-2">
                <x-input-label for="issue_date" :value="__('Date de délivrance')" />
            </div>
            <div class="col-md-1 d-flex pt-2">
                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de délivrance CIN" role="img" aria-label="Date de délivrance CIN"></i>
            </div>
            <div class="col-md-7">
                <x-text-input id="issue_date" name="issue_date" type="date" :value="optional($profile->issue_date)->format('Y-m-d')" />
                <x-input-error class="mt-2" :messages="$errors->get('issue_date')" />
            </div>

            <!-- Issue Place -->
            <div class="col-md-4 d-flex pt-2">
                <x-input-label for="issue_place" :value="__('Lieu de délivrance')" />
            </div>
            <div class="col-md-1 d-flex pt-2">
                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu de délivrance CIN" role="img" aria-label="Lieu de délivrance CIN"></i>
            </div>
            <div class="col-md-7">
                <x-text-input id="issue_place" name="issue_place" type="text" :value="$profile->issue_place" placeholder="Entrer lieu de délivrance" />
                <x-input-error class="mt-2" :messages="$errors->get('issue_place')" />
            </div>

            <!-- Duplicate Date -->
            <div class="col-md-4 d-flex pt-2">
                <x-input-label for="duplicate_date" :value="__('Date de duplication')" />
            </div>
            <div class="col-md-1 d-flex pt-2">
                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de duplicata CIN" role="img" aria-label="Date de duplicata CIN"></i>
            </div>
            <div class="col-md-7">
                <x-text-input id="duplicate_date" name="duplicate_date" type="date" :value="optional($profile->duplicate_date)->format('Y-m-d')" />
                <x-input-error class="mt-2" :messages="$errors->get('duplicate_date')" />
            </div>

            <!-- Duplicate Place -->
            <div class="col-md-4 d-flex pt-2">
                <x-input-label for="duplicate_place" :value="__('Lieu de duplication')" />
            </div>
            <div class="col-md-1 d-flex pt-2">
                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu de duplicata CIN" role="img" aria-label="Lieu de duplicata CIN"></i>
            </div>
            <div class="col-md-7">
                <x-text-input id="duplicate_place" name="duplicate_place" type="text" :value="$profile->duplicate_place" placeholder="Entrer lieu de duplication" />
                <x-input-error class="mt-2" :messages="$errors->get('duplicate_place')" />
            </div>

            <!-- Address -->
            <div class="col-md-4 d-flex pt-2">
                <x-input-label for="address" :value="__('Adresse actuelle')" />
            </div>
            <div class="col-md-1 d-flex pt-2">
                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Adresse actuelle" role="img" aria-label="Adresse actuelle"></i>
            </div>
            <div class="col-md-7">
                <x-textarea-input id="address" name="address" rows="3" placeholder="Entrer adresse du domicille">{{ $profile->address }}</x-textarea-input>
                <x-input-error class="mt-2" :messages="$errors->get('address')" />
            </div>

            <!-- Phone -->
            <div class="col-md-4 d-flex pt-2">
                <x-input-label for="phone" :value="__('Numéro téléphone')" />
            </div>
            <div class="col-md-1 d-flex pt-2">
                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Numéro téléphone mobile" role="img" aria-label="Numéro téléphone mobile"></i>
            </div>
            <div class="col-md-7">
                <x-text-input id="phone" name="phone" type="tel" :value="$profile->phone" placeholder="Entrer numéro de téléphone" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>

            <!-- Email -->
            <div class="col-md-4 d-flex pt-2">
                <x-input-label for="email" :value="__('Email')" />
            </div>
            <div class="col-md-1 d-flex pt-2">
                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Adresse électronique" role="img" aria-label="Adresse électronique"></i>
            </div>
            <div class="col-md-7">
                <x-text-input id="email" name="email" type="email" :value="$profile->email" placeholder="Entrer adresse email" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <!-- Blood Group -->
            <div class="col-md-4 d-flex pt-2">
                <x-input-label for="blood_group" :value="__('Groupe sanguin')" />
            </div>
            <div class="col-md-1 d-flex pt-2">
                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Groupe sanguin" role="img" aria-label="Groupe sanguin"></i>
            </div>
            <div class="col-md-7">
                <x-text-input id="blood_group" name="blood_group" type="text" :value="$profile->blood_group" placeholder="Entrer groupe sanguin" />
                <x-input-error class="mt-2" :messages="$errors->get('blood_group')" />
            </div>

            <!-- Size -->
            <div class="col-md-4 d-flex pt-2">
                <x-input-label for="size" :value="__('Taille (en cm)')" />
            </div>
            <div class="col-md-1 d-flex pt-2">
                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Taille en centimètre" role="img" aria-label="Taille en centimètre"></i>
            </div>
            <div class="col-md-7">
                <x-text-input id="size" name="size" type="number" min="150" :value="$profile->size" placeholder="Entrer taille en centimètre" />
                <x-input-error class="mt-2" :messages="$errors->get('size')" />
            </div>

            <!-- Father Name -->
            <div class="col-md-4 d-flex pt-2">
                <x-input-label for="father_name" :value="__('Nom du père')" />
            </div>
            <div class="col-md-1 d-flex pt-2">
                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Nom du père biologique" role="img" aria-label="Nom du père biologique"></i>
            </div>
            <div class="col-md-7">
                <x-text-input id="father_name" name="father_name" type="text" :value="$profile->father_name" placeholder="Entrer nom du père" />
                <x-input-error class="mt-2" :messages="$errors->get('father_name')" />
            </div>

            <!-- Mother Name -->
            <div class="col-md-4 d-flex pt-2">
                <x-input-label for="mother_name" :value="__('Nom de la mère')" />
            </div>
            <div class="col-md-1 d-flex pt-2">
                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Nom de la mère biologique" role="img" aria-label="Nom de la mère biologique"></i>
            </div>
            <div class="col-md-7">
                <x-text-input id="mother_name" name="mother_name" type="text" :value="$profile->mother_name" placeholder="Entrer nom de la mère" />
                <x-input-error class="mt-2" :messages="$errors->get('mother_name')" />
            </div>

            <!-- Marital Status -->
            <div class="col-md-4 d-flex pt-2">
                <x-input-label for="marital_status" :value="__('Situation matrimoniale')" />
            </div>
            <div class="col-md-1 d-flex pt-2">
                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Situation matrimoniale" role="img" aria-label="Situation matrimoniale"></i>
            </div>
            <div class="col-md-7">
                <x-select-input id="marital_status" name="marital_status" >
                    <option value="" {{ $profile->marital_status == null ? 'selected' : '' }} disabled>{{ __('Choisir à la selection') }}</option>
                    <option value="Célibataire" {{ $profile->marital_status == 'Célibataire' ? 'selected' : '' }}>{{ __('Célibataire') }}</option>
                    <option value="Marié(e)" {{ $profile->marital_status == 'Marié(e)' ? 'selected' : '' }}>{{ __('Marié(e)') }}</option>
                    <option value="Divorcé(e)" {{ $profile->marital_status == 'Divorcé(e)' ? 'selected' : '' }}>{{ __('Divorcé(e)') }}</option>
                    <option value="Veuf/Veuve" {{ $profile->marital_status == 'Veuf/Veuve' ? 'selected' : '' }}>{{ __('Veuf/Veuve') }}</option>
                </x-select-input>
                <x-input-error class="mt-2" :messages="$errors->get('marital_status')" />
            </div>

            <!-- Fallback Address -->
            <div class="col-md-4 d-flex pt-2">
                <x-input-label for="fallback_address" :value="__('Adresse de repli')" />
            </div>
            <div class="col-md-1 d-flex pt-2">
                <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Adresse de repli" role="img" aria-label="Adresse de repli"></i>
            </div>
            <div class="col-md-7">
                <x-textarea-input id="fallback_address" name="fallback_address" rows="3" placeholder="Entrer adresse de repli">{{ $profile->fallback_address }}</x-textarea-input>
                <x-input-error class="mt-2" :messages="$errors->get('fallback_address')" />
            </div>
        </div>
        <hr class="my-3">
        <div class="text-center">
            <button type="reset" class="btn btn-secondary">Réinitialiser</button>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
</div>
