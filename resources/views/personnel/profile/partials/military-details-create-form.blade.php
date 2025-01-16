    <section class="row g-3">
        <!-- Position -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="position" :value="__('Position')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Position actuelle" role="img" aria-label="Position actuelle"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-select-input id="position" name="position">
                <option value="" {{ old('position') == null ? 'selected' : '' }} disabled >{{ __('Choisir à la selection') }}</option>
                <option value="active" {{ old('position') == 'active' ? 'selected' : '' }}>{{ __('En activité') }}</option>
                <option value="detache" {{ old('position') == 'detache' ? 'selected' : '' }}>{{ __('En service détaché') }}</option>
                <option value="reserve" {{ old('position') == 'reserve' ? 'selected' : '' }}>{{ __('En réserve') }}</option>
                <option value="retired" {{ old('position') == 'retired' ? 'selected' : '' }}>{{ __('A la retraite') }}</option>
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('position')" />
        </div>

        <!-- Position Date -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="position_date" :value="__('Date de position')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de position actuelle" role="img" aria-label="Date de position actuelle"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="position_date" name="position_date" type="date" :value="old('position_date')" />
            <x-input-error class="mt-2" :messages="$errors->get('position_date')" />
        </div>

        <!-- Position Reference -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="position_reference" :value="__('Référence de position')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Référence de position" role="img" aria-label="Référence de position"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="position_reference" name="position_reference" type="text" :value="old('position_reference')" placeholder="Entrer référence" />
            <x-input-error class="mt-2" :messages="$errors->get('position_reference')" />
        </div>

         <!-- Army -->
         <div class="col-md-4 d-flex pt-2">
            <x-input-label for="army" :value="__('Armée')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Sélectionnez l'armée" role="img" aria-label="Sélectionnez l'armée"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-select-input id="army" name="army" >
                <option value="" {{ old('army') == null ? 'selected' : '' }} disabled>{{ __('Choisir à la selection') }}</option>
                <option value="land" {{ old('army') == 'land' ? 'selected' : '' }}>{{ __('Terre') }}</option>
                <option value="air" {{ old('army') == 'air' ? 'selected' : '' }}>{{ __('Air') }}</option>
                <option value="navy" {{ old('army') == 'navy' ? 'selected' : '' }}>{{ __('Mer') }}</option>
                <option value="gendarme" {{ old('gendarme') == 'gendarme' ? 'selected' : '' }}>{{ __('Gendarmerie') }}</option>
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('army')" />
        </div>

         <!-- Corps Assignment -->
         <div class="col-md-4 d-flex pt-2">
            <x-input-label for="corps_assignment" :value="__('Corps')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Corps" role="img" aria-label="Corps"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-select-input id="corps_assignment" name="corps_assignment">
                <option value="" {{ old('corps_assignment') == null ? 'selected' : '' }} disabled>{{ __('Choisir à la selection') }}</option>
                <option value="BANA" {{ old('corps_assignment') == 'BANA' ? 'selected' : '' }}>{{ __('BANA') }}</option>
                <option value="BIMA" {{ old('corps_assignment') == 'BIMA' ? 'selected' : '' }}>{{ __('BIMA') }}</option>
                <option value="BATINF" {{ old('corps_assignment') == 'BATINF' ? 'selected' : '' }}>{{ __('BATINF') }}</option>
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('corps_assignment')" />
        </div>

        <!-- Unit Assignment -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="unit_assignment" :value="__('Unité d\'affectation')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Unité support d\'affectation" role="img" aria-label="Unité support d\'affectation"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-select-input id="unit_assignment" name="unit_assignment" >
                <option value="" disabled {{ old('unit_assignment') == null ? 'selected' : '' }} >{{ __('Choisir à la selection') }}</option>
                @foreach($units as $unit)
                    <option value="{{ $unit->abbreviate }}" {{ old('unit_assignment') == $unit->abbreviate ? 'selected' : '' }} title="{{ $unit->abbreviate }}" >{{ $unit->name }}</option>
                @endforeach
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('unit_assignment')" />
        </div>

        <!-- Exact assignment -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="exact_assignment" :value="__('Lieu d\'emploi exacte (si en service détaché)')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu d'emploi exacte" role="img" aria-label="Lieu d'emploi exacte"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="exact_assignment" name="exact_assignment" type="text" :value="old('exact_assignment')" placeholder="Entrer lieu d'emploi exacte" />
            <x-input-error class="mt-2" :messages="$errors->get('exact_assignment')" />
        </div>

         <!-- Rank -->
         <div class="col-md-4 d-flex pt-2">
            <x-input-label for="rank" :value="__('Grade')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Rang militaire" role="img" aria-label="Rang militaire"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-select-input id="rank" name="rank" >
                <option value="" disabled {{ old('rank') == null ? 'selected' : '' }} >Choisir à la selection</option>
                @foreach($ranks as $rank)
                    <option value="{{ $rank->abbreviate }}" {{ old('rank') == $rank->abbreviate ? 'selected' : '' }} title="{{ $rank->abbreviate }}" >{{ $rank->name }}</option>
                @endforeach
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('rank')" />
        </div>

        <!-- Rank Date -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="rank_date" :value="__('Date de nomination')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de nomination du grade actuel" role="img" aria-label="Date de nomination du grade actuel"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="rank_date" name="rank_date" type="date" :value="old('rank_date')" />
            <x-input-error class="mt-2" :messages="$errors->get('rank_date')" />
        </div>

        <!-- Military Registration Number -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="military_registration_number" :value="__('Numéro matricule militaire')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Numéro matricule militaire" role="img" aria-label="Numéro matricule militaire"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="military_registration_number" name="military_registration_number" type="text" :value="old('military_registration_number')" placeholder="Entrer numéro matricule militaire" />
            <x-input-error class="mt-2" :messages="$errors->get('military_registration_number')" />
        </div>

        <!-- Finance Registration Number -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="finance_registration_number" :value="__('Numéro matricule finance')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Numéro matricule finance" role="img" aria-label="Numéro matricule finance"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="finance_registration_number" name="finance_registration_number" type="text" :value="old('finance_registration_number')" placeholder="Entrer numéro matricule finance"  />
            <x-input-error class="mt-2" :messages="$errors->get('finance_registration_number')" />
        </div>

        <!-- Specialty -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="specialty" :value="__('Spécialité')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Spécialité militaire" role="img" aria-label="Spécialité militaire"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="specialty" name="specialty" type="text" :value="old('specialty')" placeholder="Entrer spécialité" />
            <x-input-error class="mt-2" :messages="$errors->get('specialty')" />
        </div>

        <!-- Current function -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="current_function" :value="__('Fonction actuelle')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Fonction ou emploi actuel" role="img" aria-label="Fonction ou emploi actuel"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="current_function" name="current_function" type="text" :value="old('current_function')" placeholder="Entrer fonction ou emploi actuel" />
            <x-input-error class="mt-2" :messages="$errors->get('current_function')" />
        </div>

        <!-- Service Entry Date -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="service_entry_date" :value="__('Date d\'entrée au service')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date d'entrée dans le service militaire" role="img" aria-label="Date d'entrée dans le service militaire"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="service_entry_date" name="service_entry_date" type="date" :value="old('service_entry_date')"/>
            <x-input-error class="mt-2" :messages="$errors->get('service_entry_date')" />
        </div>

        <!-- Recruitment origin -->
          <div class="col-md-4 d-flex pt-2">
            <x-input-label for="recruitment_origin" :value="__('Origine de recrutement')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu d'origine de recrutement" role="img" aria-label="Lieu d'origine de recrutement"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="recruitment_origin" name="recruitment_origin" type="text" :value="old('recruitment_origin')" placeholder="Entrer lieu de recrutement" />
            <x-input-error class="mt-2" :messages="$errors->get('recruitment_origin')" />
        </div>

        <!-- Recruitment_promotion -->
          <div class="col-md-4 d-flex pt-2">
            <x-input-label for="recruitment_promotion" :value="__('Classe d\'âge ou promotion')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Classe d'âge ou promotion" role="img" aria-label="Classe d'âge ou promotion"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="recruitment_promotion" name="recruitment_promotion" type="text" :value="old('recruitment_promotion')" placeholder="Entrer classe d'âge ou promotion" />
            <x-input-error class="mt-2" :messages="$errors->get('recruitment_promotion')" />
        </div>

        <!-- Interruption start Date -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="interruption_start_date" :value="__('Début d\'interruption')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date du début d'interruption" role="img" aria-label="Date du début d'interruption"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="interruption_start_date" name="interruption_start_date" type="date" :value="old('interruption_start_date')" />
            <x-input-error class="mt-2" :messages="$errors->get('interruption_start_date')" />
        </div>

        <!-- Interruption end Date -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="interruption_end_date" :value="__('Fin d\'interruption')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de fin d'interruption" role="img" aria-label="Date de fin d'interruption"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="interruption_end_date" name="interruption_end_date" type="date" :value="old('interruption_end_date')" />
            <x-input-error class="mt-2" :messages="$errors->get('interruption_end_date')" />
        </div>

         <!-- Military status -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="military_status" :value="__('Statut militaire')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Statut militaire" role="img" aria-label="Statut militaire"></i>
        </div>
        <div class="col-md-7">
            <x-select-input id="military_status" name="military_status">
                <option value="" {{ old('military_status') == null ? 'selected' : '' }} disabled>{{ __('Choisir à la selection') }}</option>
                <option value="OA" {{ old('military_status') == 'OA' ? 'selected' : '' }}>{{ __('Officier de carrière') }}</option>
                <option value="SOC" title="Sous-officier de carrière" {{ old('military_status') == 'SOC' ? 'selected' : '' }}>{{ __('SOC') }}</option>
                <option value="HDRC" title="Homme du rang de carrière" {{ old('military_status') == 'HDRC' ? 'selected' : '' }}>{{ __('HDRC') }}</option>
                <option value="SC" title="Sous-contrat" {{ old('military_status') == 'SC' ? 'selected' : '' }}>{{ __('Sous-contrat') }}</option>
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('military_status')" />
        </div>

         <!-- Statut Reference -->
         <div class="col-md-4 d-flex pt-2">
            <x-input-label for="military_status_reference" :value="__('Référence statut')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Référence de statut militaire" role="img" aria-label="Référence de statut militaire"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="military_status_reference" name="military_status_reference" type="text" :value="old('military_status_reference')" placeholder="Entrer référence" />
            <x-input-error class="mt-2" :messages="$errors->get('military_status_reference')" />
        </div>

        <!-- Military ID Card Number -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="military_id_card_number" :value="__('Numéro carte militaire')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Numéro de carte militaire" role="img" aria-label="Numéro de carte militaire"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="military_id_card_number" name="military_id_card_number" type="text" :value="old('military_id_card_number')" placeholder="Entrer numéro de carte militaire" />
            <x-input-error class="mt-2" :messages="$errors->get('military_id_card_number')" />
        </div>

        <!-- Military driver licence -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="military_driver_license" :value="__('Permis militaire')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Permis militaire" role="img" aria-label="Permis militaire"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="military_driver_license" name="military_driver_license" type="text" :value="old('military_driver_license')" placeholder="Entrer permis militaire" />
            <x-input-error class="mt-2" :messages="$errors->get('military_driver_license')" />
        </div>

         <!-- Other informations -->
         <div class="col-md-4 d-flex pt-2">
            <x-input-label for="other_information" :value="__('Autres informations')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Autres informations" role="img" aria-label="Autres informations"></i>
        </div>
        <div class="col-md-7">
            <x-textarea-input id="other_information" name="other_information" rows="3" placeholder="Entrer autres informations">{{ old('other_information') }}</x-textarea-input>
            <x-input-error class="mt-2" :messages="$errors->get('other_information')" />
        </div>
    </section>
