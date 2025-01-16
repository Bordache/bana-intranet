<!-- Conteneur des sections de carrière -->
<section id="career-paths-container">
    @if (old('company_name'))
        @foreach (old('company_name') as $index => $companyName)
            <div class="career-path pb-4 row g-3">

                <!-- Lieu d'emploi -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="company_name_{{ $index }}" :value="__('Lieu d\'emploi')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu d'affectation" role="img" aria-label="Lieu d'affectation"></i>
                    <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="company_name_{{ $index }}" name="company_name[]" type="text"
                                  placeholder="Entrer lieu d'emploi"
                                  value="{{ $companyName }}"
                                  class="{{ $errors->has('company_name.' . $index) ? 'is-invalid' : '' }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('company_name.' . $index)" />
                </div>

                <!-- Fonction ou emploi -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="job_title_{{ $index }}" :value="__('Fonction ou emploi tenu')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Fonction ou emploi tenu" role="img" aria-label="Fonction ou emploi tenu"></i>
                    <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="job_title_{{ $index }}" name="job_title[]" type="text"
                                  placeholder="Entrer fonction ou emploi"
                                  value="{{ old('job_title.' . $index) }}"
                                  class="{{ $errors->has('job_title.' . $index) ? 'is-invalid' : '' }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('job_title.' . $index)" />
                </div>

                <!-- Début d'affectation -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="start_date_{{ $index }}" :value="__('Début d\'affectation')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de début d'affectation" role="img" aria-label="Date de début d'affectation"></i>
                    <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="start_date_{{ $index }}" name="start_date[]" type="date"
                                  value="{{ old('start_date.' . $index) }}"
                                  class="{{ $errors->has('start_date.' . $index) ? 'is-invalid' : '' }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('start_date.' . $index)" />
                </div>

                <!-- Fin d'affectation -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="end_date_{{ $index }}" :value="__('Fin d\'affectation')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de fin d'affectation" role="img" aria-label="Date de fin d'affectation"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="end_date_{{ $index }}" name="end_date[]" type="date"
                                  value="{{ old('end_date.' . $index) }}"
                                  class="{{ $errors->has('end_date.' . $index) ? 'is-invalid' : '' }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('end_date.' . $index)" />
                </div>

                <!-- Référence -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="description_{{ $index }}" :value="__('Référence')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Décision ou décret" role="img" aria-label="Décision ou décret"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="description_{{ $index }}" name="description[]" type="text"
                                  placeholder="Entrer décision ou décret"
                                  value="{{ old('description.' . $index) }}"
                                  class="{{ $errors->has('description.' . $index) ? 'is-invalid' : '' }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('description.' . $index)" />
                </div>

                <div class="col-md-12 text-end mt-3">
                    <button type="button" class="btn btn-danger remove-career-btn">Supprimer ce parcours</button>
                </div>
                <hr class="mt-4">
            </div>
        @endforeach
    @endif
</section>

<!-- Bouton "Ajouter parcours professionnel" -->
<div class="mb-3 text-end">
    <button id="add-career-btn" type="button" class="btn btn-primary">Ajouter parcours professionnel</button>
</div>

<!-- Template pour les sections de carrière -->
<template id="career-template">
    <div class="career-path pb-4 row g-3">
        <!-- Lieu d'emploi -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="company_name" :value="__('Lieu d\'emploi')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu d'affectation" role="img" aria-label="Lieu d'affectation"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="company_name" name="company_name[]" type="text" placeholder="Entrer lieu d'emploi" />
        </div>

        <!-- Fonction ou emploi -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="job_title" :value="__('Fonction ou emploi tenu')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Fonction ou emploi tenu" role="img" aria-label="Fonction ou emploi tenu"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="job_title" name="job_title[]" type="text" placeholder="Entrer fonction ou emploi" />
        </div>

        <!-- Début d'affectation -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="start_date" :value="__('Début d\'affectation')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de début d'affectation" role="img" aria-label="Date de début d'affectation"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="start_date" name="start_date[]" type="date" />
        </div>

        <!-- Fin d'affectation -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="end_date" :value="__('Fin d\'affectation')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de fin d'affectation" role="img" aria-label="Date de fin d'affectation"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="end_date" name="end_date[]" type="date" />
        </div>

        <!-- Référence -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="description" :value="__('Référence')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Décision ou décret" role="img" aria-label="Décision ou décret"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="description" name="description[]" type="text" placeholder="Entrer décision ou décret" />
        </div>

        <div class="col-md-12 text-end mt-3">
            <button type="button" class="btn btn-danger remove-career-btn">Supprimer ce parcours</button>
        </div>
        <hr class="mt-4">
    </div>
</template>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const addCareerBtn = document.getElementById('add-career-btn');
    const careerPathsContainer = document.getElementById('career-paths-container');
    const careerTemplate = document.getElementById('career-template');

    // Ajout dynamique des parcours professionnels
    addCareerBtn.addEventListener('click', () => {
        const templateContent = careerTemplate.content.cloneNode(true);
        const timestamp = Date.now();

        // Modifier les IDs et les attributs "for" pour chaque élément dynamique
        templateContent.querySelectorAll('[id]').forEach(input => {
            const newId = `${input.id}_${timestamp}`;
            const label = templateContent.querySelector(`label[for="${input.id}"]`);
            if (label) {
                label.setAttribute('for', newId);
            }
            input.id = newId;
        });

        careerPathsContainer.appendChild(templateContent);
    });

    // Suppression dynamique des parcours professionnels
    careerPathsContainer.addEventListener('click', (event) => {
        if (event.target.classList.contains('remove-career-btn')) {
            const careerPath = event.target.closest('.career-path');
            if (careerPath) {
                careerPath.remove();
            }
        }
    });
});
</script>
