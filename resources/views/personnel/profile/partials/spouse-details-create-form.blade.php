<section class="row g-3">
    <!-- Spouse name -->
    <div class="col-md-4 d-flex pt-2">
        <x-input-label for="spouse_name" :value="__('Nom')" />
    </div>
    <div class="col-md-1 d-flex pt-2">
        <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Nom d'usage de l'époux(se)" role="img" aria-label="Nom d'usage de l'époux(se)"></i>
        <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
    </div>
    <div class="col-md-7">
        <x-text-input id="spouse_name" name="spouse_name" type="text" :value="old('spouse_name')" placeholder="Entrer nom" class="{{ $errors->has('spouse_name') ? 'is-invalid' : '' }}" />
        <x-input-error class="mt-2" :messages="$errors->get('spouse_name')" />
    </div>

    <!-- Spouse maiden name -->
    <div class="col-md-4 d-flex pt-2">
        <x-input-label for="spouse_maiden_name" :value="__('Nom de jeune fille')" />
    </div>
    <div class="col-md-1 d-flex pt-2">
        <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Nom de famille de l'épouse avant le mariage (si différent du nom d'usage)" role="img" aria-label="Nom de famille de l'épouse avant le mariage (si différent du nom d'usage)"></i>
    </div>
    <div class="col-md-7">
        <x-text-input id="spouse_maiden_name" name="spouse_maiden_name" type="text" :value="old('spouse_maiden_name')" placeholder="Entrer nom de jeune fille" />
        <x-input-error class="mt-2" :messages="$errors->get('spouse_maiden_name')" />
    </div>

    <!-- Firstname -->
    <div class="col-md-4 d-flex pt-2">
        <x-input-label for="spouse_firstname" :value="__('Prénom(s)')" />
    </div>
    <div class="col-md-1 d-flex pt-2">
        <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Prénom(s) de naissance" role="img" aria-label="Prénom(s) de naissance"></i>
    </div>
    <div class="col-md-7">
        <x-text-input id="spouse_firstname" name="spouse_firstname" type="text" :value="old('spouse_firstname')" placeholder="Entrer prénom(s)" />
        <x-input-error class="mt-2" :messages="$errors->get('spouse_firstname')" />
    </div>

    <!-- Birth Date -->
    <div class="col-md-4 d-flex pt-2">
        <x-input-label for="spouse_birth_date" :value="__('Date de naissance')" />
    </div>
    <div class="col-md-1 d-flex pt-2">
        <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de naissance" role="img" aria-label="Date de naissance"></i>
    </div>
    <div class="col-md-7">
        <x-text-input id="spouse_birth_date" name="spouse_birth_date" type="date" :value="old('spouse_birth_date')" />
        <x-input-error class="mt-2" :messages="$errors->get('spouse_birth_date')" />
    </div>

    <!-- Birth Place -->
    <div class="col-md-4 d-flex pt-2">
        <x-input-label for="spouse_birth_place" :value="__('Lieu de naissance')" />
    </div>
    <div class="col-md-1 d-flex pt-2">
        <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu de naissance" role="img" aria-label="Lieu de naissance"></i>
    </div>
    <div class="col-md-7">
        <x-text-input id="spouse_birth_place" name="spouse_birth_place" type="text" :value="old('spouse_birth_place')" placeholder="Entrer lieu de naissance" />
        <x-input-error class="mt-2" :messages="$errors->get('spouse_birth_place')" />
    </div>

    <!-- Profession -->
    <div class="col-md-4 d-flex pt-2">
        <x-input-label for="spouse_profession" :value="__('Profession')" />
    </div>
    <div class="col-md-1 d-flex pt-2">
        <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Profession ou activité" role="img" aria-label="Profession ou activité"></i>
    </div>
    <div class="col-md-7">
        <x-text-input id="spouse_profession" name="spouse_profession" type="text" :value="old('spouse_profession')" placeholder="Entrer profession ou activité" />
        <x-input-error class="mt-2" :messages="$errors->get('spouse_profession')" />
    </div>

    <!-- Marriage authorization -->
    <div class="col-md-4 d-flex pt-2">
        <x-input-label for="marriage_authorization" :value="__('Autorisation de mariage')" />
    </div>
    <div class="col-md-1 d-flex pt-2">
        <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Autorisation de mariage" role="img" aria-label="Autorisation de mariage"></i>
    </div>
    <div class="col-md-7">
        <x-text-input id="marriage_authorization" name="marriage_authorization" type="text" :value="old('marriage_authorization')" placeholder="Entrer autorisation de mariage" />
        <x-input-error class="mt-2" :messages="$errors->get('marriage_authorization')" />
    </div>

</section>
