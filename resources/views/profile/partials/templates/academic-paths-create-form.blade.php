<!-- Conteneur des sections académiques -->
<section id="academic-paths-container">
    @if (old('school_name'))
        @foreach (old('school_name') as $index => $schoolName)
            <div class="academic-path pb-4 row g-3">

                <!-- Établissement fréquenté -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="school_name_{{ $index }}" :value="__('Etablissement fréquenté')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Ecole, collège, lycée, institut, université ..." role="img" aria-label="Ecole, collège, lycée, institut, université ..."></i>
                    <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="school_name_{{ $index }}" name="school_name[]" type="text"
                                  placeholder="Entrer nom de l'établissement fréquenté"
                                  value="{{ $schoolName }}"
                                  class="{{ $errors->has('school_name.' . $index) ? 'is-invalid' : '' }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('school_name.' . $index)" />
                </div>

                <!-- Période -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="duration_{{ $index }}" :value="__('Période')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Période" role="img" aria-label="Période"></i>
                    <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="duration_{{ $index }}" name="duration[]" type="text"
                                  placeholder="Entrer période"
                                  value="{{ old('duration.' . $index) }}"
                                  class="{{ $errors->has('duration.' . $index) ? 'is-invalid' : '' }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('duration.' . $index)" />
                </div>

                <!-- Diplômes -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="diploma_{{ $index }}" :value="__('Sanctions')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Sanctions d'études" role="img" aria-label="Sanctions d'études"></i>
                </div>
                <div class="col-md-7">
                    <x-textarea-input id="diploma_{{ $index }}" name="diploma[]" rows="3"
                                      class="{{ $errors->has('diploma.' . $index) ? 'is-invalid' : '' }}"
                                      placeholder="Entrer diplômes, certificats ou attestations obtenus">{{ old('diploma.' . $index) }}</x-textarea-input>
                    <x-input-error class="mt-2" :messages="$errors->get('diploma.' . $index)" />
                </div>

                <div class="col-md-12 text-end mt-3">
                    <button type="button" class="btn btn-danger remove-academic-btn">Supprimer ce parcours</button>
                </div>
                <hr class="mt-4">
            </div>
        @endforeach
    @endif
</section>

<!-- Bouton "Ajouter parcours académique" -->
<div class="mb-3 text-end">
    <button id="add-academic-btn" type="button" class="btn btn-primary">Ajouter parcours académique</button>
</div>

<!-- Template pour les sections académiques -->
<template id="academic-template">
    <div class="academic-path pb-4 row g-3">
        <!-- Établissement fréquenté -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="school_name" :value="__('Etablissement fréquenté')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Ecole, collège, lycée, institut, université ..." role="img" aria-label="Ecole, collège, lycée, institut, université ..."></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="school_name" name="school_name[]" type="text"
                          placeholder="Entrer nom de l'établissement fréquenté" />
        </div>

        <!-- Période -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="duration" :value="__('Période')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Période" role="img" aria-label="Période"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="duration" name="duration[]" type="text"
                          placeholder="Entrer période" />
        </div>

        <!-- Diplômes -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="diploma" :value="__('Sanctions')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Sanctions d'études" role="img" aria-label="Sanctions d'études"></i>
        </div>
        <div class="col-md-7">
            <x-textarea-input id="diploma" name="diploma[]" rows="3" placeholder="Entrer diplômes, certificats ou attestations obtenus"></x-textarea-input>
        </div>

        <div class="col-md-12 text-end mt-3">
            <button type="button" class="btn btn-danger remove-academic-btn">Supprimer ce parcours</button>
        </div>
        <hr class="mt-4">
    </div>
</template>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const addAcademicBtn = document.getElementById('add-academic-btn');
    const academicContainer = document.getElementById('academic-paths-container');
    const academicTemplate = document.getElementById('academic-template');

    // Ajout dynamique des parcours académiques
    addAcademicBtn.addEventListener('click', () => {
        const templateContent = academicTemplate.content.cloneNode(true);
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

        academicContainer.appendChild(templateContent);
        cleanTextareaInput(`diploma_${timestamp}`);
    });

    // Suppression dynamique des parcours académiques
    academicContainer.addEventListener('click', (event) => {
        if (event.target.classList.contains('remove-academic-btn')) {
            const academicPath = event.target.closest('.academic-path');
            if (academicPath) {
                academicPath.remove();
            }
        }
    });
});
</script>
