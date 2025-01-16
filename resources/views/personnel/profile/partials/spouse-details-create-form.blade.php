<!-- Conteneur des détails des conjoints -->
<section id="spouse-details-container">
    @if (old('spouse_name'))
        @foreach (old('spouse_name') as $index => $spouseName)
            <div class="spouse-detail pb-4 row g-3">

                <!-- Nom -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="spouse_name_{{ $index }}" :value="__('Nom')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Nom d'usage de l'époux(se)" role="img" aria-label="Nom d'usage de l'époux(se)"></i>
                    <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="spouse_name_{{ $index }}" name="spouse_name[]" type="text"
                                  placeholder="Entrer nom"
                                  value="{{ $spouseName }}"
                                  class="{{ $errors->has('spouse_name.' . $index) ? 'is-invalid' : '' }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('spouse_name.' . $index)" />
                </div>

                <!-- Nom de jeune fille -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="spouse_maiden_name_{{ $index }}" :value="__('Nom de jeune fille')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Nom de famille de l'épouse avant le mariage (si différent du nom d'usage)" role="img" aria-label="Nom de famille de l'épouse avant le mariage (si différent du nom d'usage)"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="spouse_maiden_name_{{ $index }}" name="spouse_maiden_name[]" type="text"
                                  placeholder="Entrer nom de jeune fille"
                                  value="{{ old('spouse_maiden_name.' . $index) }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('spouse_maiden_name.' . $index)" />
                </div>

                <!-- Prénom(s) -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="spouse_firstname_{{ $index }}" :value="__('Prénom(s)')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Prénom(s) de naissance" role="img" aria-label="Prénom(s) de naissance"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="spouse_firstname_{{ $index }}" name="spouse_firstname[]" type="text"
                                  placeholder="Entrer prénom(s)"
                                  value="{{ old('spouse_firstname.' . $index) }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('spouse_firstname.' . $index)" />
                </div>

                <!-- Date de naissance -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="spouse_birth_date_{{ $index }}" :value="__('Date de naissance')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de naissance" role="img" aria-label="Date de naissance"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="spouse_birth_date_{{ $index }}" name="spouse_birth_date[]" type="date"
                                  value="{{ old('spouse_birth_date.' . $index) }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('spouse_birth_date.' . $index)" />
                </div>

                <!-- Lieu de naissance -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="spouse_birth_place_{{ $index }}" :value="__('Lieu de naissance')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu de naissance" role="img" aria-label="Lieu de naissance"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="spouse_birth_place_{{ $index }}" name="spouse_birth_place[]" type="text"
                                  placeholder="Entrer lieu de naissance"
                                  value="{{ old('spouse_birth_place.' . $index) }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('spouse_birth_place.' . $index)" />
                </div>

                <!-- Profession -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="spouse_profession_{{ $index }}" :value="__('Profession')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Profession ou activité" role="img" aria-label="Profession ou activité"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="spouse_profession_{{ $index }}" name="spouse_profession[]" type="text"
                                  placeholder="Entrer profession ou activité"
                                  value="{{ old('spouse_profession.' . $index) }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('spouse_profession.' . $index)" />
                </div>

                <!-- Autorisation de mariage -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="marriage_authorization_{{ $index }}" :value="__('Autorisation de mariage')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Autorisation de mariage" role="img" aria-label="Autorisation de mariage"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="marriage_authorization_{{ $index }}" name="marriage_authorization[]" type="text"
                                  placeholder="Entrer autorisation de mariage"
                                  value="{{ old('marriage_authorization.' . $index) }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('marriage_authorization.' . $index)" />
                </div>

                <div class="col-md-12 text-end mt-3">
                    <button type="button" class="btn btn-danger remove-spouse-btn">Supprimer conjoint(e)</button>
                </div>
            </div>
        @endforeach
    @endif
</section>

<!-- Bouton "Ajouter conjoint(e)" -->
<div id="add-spouse-btn-container" class="mb-3 text-end">
    <button id="add-spouse-btn" type="button" class="btn btn-primary">Ajouter conjoint(e)</button>
</div>

<!-- Template pour les conjoints -->
<template id="spouse-template">
    <div class="spouse-detail pb-4 row g-3">
        <!-- Nom -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="spouse_name" :value="__('Nom')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Nom d'usage de l'époux(se)" role="img" aria-label="Nom d'usage de l'époux(se)"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="spouse_name" name="spouse_name[]" type="text" placeholder="Entrer nom"  />
        </div>

        <!-- Nom de jeune fille -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="spouse_maiden_name" :value="__('Nom de jeune fille')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Nom de famille de l'épouse avant le mariage (si différent du nom d'usage)" role="img" aria-label="Nom de famille de l'épouse avant le mariage (si différent du nom d'usage)"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="spouse_maiden_name" name="spouse_maiden_name[]" type="text" placeholder="Entrer nom de jeune fille"/>
        </div>

        <!-- Prénom(s) -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="spouse_firstname" :value="__('Prénom(s)')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Prénom(s) de naissance" role="img" aria-label="Prénom(s) de naissance"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="spouse_firstname" name="spouse_firstname[]" type="text" placeholder="Entrer prénom(s)"/>
        </div>

        <!-- Date de naissance -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="spouse_birth_date" :value="__('Date de naissance')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de naissance" role="img" aria-label="Date de naissance"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="spouse_birth_date" name="spouse_birth_date[]" type="date" />
        </div>

        <!-- Lieu de naissance -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="spouse_birth_place" :value="__('Lieu de naissance')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu de naissance" role="img" aria-label="Lieu de naissance"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="spouse_birth_place" name="spouse_birth_place[]" type="text" placeholder="Entrer lieu de naissance" />
        </div>

        <!-- Profession -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="spouse_profession" :value="__('Profession')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Profession ou activité" role="img" aria-label="Profession ou activité"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="spouse_profession" name="spouse_profession[]" type="text" placeholder="Entrer profession ou activité" />
        </div>

        <!-- Autorisation de mariage -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="marriage_authorization" :value="__('Autorisation de mariage')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Autorisation de mariage" role="img" aria-label="Autorisation de mariage"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="marriage_authorization" name="marriage_authorization[]" type="text" placeholder="Entrer autorisation de mariage" />
        </div>

        <div class="col-md-12 text-end mt-3">
            <button type="button" class="btn btn-danger remove-spouse-btn">Supprimer conjoint(e)</button>
        </div>
    </div>
</template>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const addSpouseBtn = document.getElementById('add-spouse-btn');
    const addSpouseBtnContainer = document.getElementById('add-spouse-btn-container');
    const spouseContainer = document.getElementById('spouse-details-container');
    const spouseTemplate = document.getElementById('spouse-template');

    // Ajout dynamique des conjoints
    addSpouseBtn.addEventListener('click', () => {
        const templateContent = spouseTemplate.content.cloneNode(true);
        const timestamp = Date.now();

        templateContent.querySelectorAll('[id]').forEach(input => {
            const newId = `${input.id}_${timestamp}`;
            const label = templateContent.querySelector(`label[for="${input.id}"]`);
            if (label) label.setAttribute('for', newId);
            input.id = newId;
        });

        spouseContainer.appendChild(templateContent);
        addSpouseBtnContainer.style.display = 'none';
    });

    // Suppression dynamique des conjoints
    spouseContainer.addEventListener('click', (event) => {
        if (event.target.classList.contains('remove-spouse-btn')) {
            const spouseDetail = event.target.closest('.spouse-detail');
            if (spouseDetail) {
                spouseDetail.remove();
                addSpouseBtnContainer.style.display = 'block';
            }
        }
    });
});
</script>
