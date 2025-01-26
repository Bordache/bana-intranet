<!-- Conteneur des sections militaires -->
<section id="military-paths-container">
    @if (old('academy_name'))
        @foreach (old('academy_name') as $index => $academyName)
            <div class="military-path pb-4 row g-3">

                <!-- Centre ou école -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="academy_name_{{ $index }}" :value="__('Centre ou école')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Centre ou école fréquenté" role="img" aria-label="Centre ou école fréquenté"></i>
                    <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="academy_name_{{ $index }}" name="academy_name[]" type="text"
                                  placeholder="Entrer nom du centre ou école fréquenté"
                                  value="{{ $academyName }}"
                                  class="{{ $errors->has('academy_name.' . $index) ? 'is-invalid' : '' }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('academy_name.' . $index)" />
                </div>

                <!-- Période -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="academy_duration_{{ $index }}" :value="__('Période')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Période" role="img" aria-label="Période"></i>
                    <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="academy_duration_{{ $index }}" name="academy_duration[]" type="text"
                                  placeholder="Entrer période"
                                  value="{{ old('academy_duration.' . $index) }}"
                                  class="{{ $errors->has('academy_duration.' . $index) ? 'is-invalid' : '' }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('academy_duration.' . $index)" />
                </div>

                <!-- Diplômes -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="academy_diploma_{{ $index }}" :value="__('Sanctions')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Sanctions de stage ou de formation" role="img" aria-label="Sanctions de stage ou de formation"></i>
                </div>
                <div class="col-md-7">
                    <x-textarea-input id="academy_diploma_{{ $index }}" name="academy_diploma[]" rows="3"
                                      class="{{ $errors->has('academy_diploma.' . $index) ? 'is-invalid' : '' }}"
                                      placeholder="Entrer diplômes, certificats ou attestations obtenus">{{ old('academy_diploma.' . $index) }}</x-textarea-input>
                    <x-input-error class="mt-2" :messages="$errors->get('academy_diploma.' . $index)" />
                </div>

                <div class="col-md-12 text-end mt-3">
                    <button type="button" class="btn btn-danger remove-military-path-btn">Supprimer ce parcours</button>
                </div>
                <hr class="mt-4">
            </div>
        @endforeach
    @endif
</section>

<!-- Bouton "Ajouter parcours militaire" -->
<div class="mb-3 text-end">
    <button id="add-military-path-btn" type="button" class="btn btn-primary">Ajouter parcours militaire</button>
</div>

<!-- Template pour les sections militaires -->
<template id="military-template">
    <div class="military-path pb-4 row g-3">
        <!-- Centre ou école -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="academy_name" :value="__('Centre ou école')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Centre ou école fréquenté" role="img" aria-label="Centre ou école fréquenté"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="academy_name" name="academy_name[]" type="text"
                          placeholder="Entrer nom du centre ou école fréquenté" />
        </div>

        <!-- Période -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="academy_duration" :value="__('Période')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Période" role="img" aria-label="Période"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="academy_duration" name="academy_duration[]" type="text"
                          placeholder="Entrer période" />
        </div>

        <!-- Diplômes -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="academy_diploma" :value="__('Sanctions')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Sanctions de stage ou de formation" role="img" aria-label="Sanctions de stage ou de formation"></i>
        </div>
        <div class="col-md-7">
            <x-textarea-input id="academy_diploma" name="academy_diploma[]" rows="3" placeholder="Entrer diplômes, certificats ou attestations obtenus"></x-textarea-input>
        </div>

        <div class="col-md-12 text-end mt-3">
            <button type="button" class="btn btn-danger remove-military-path-btn">Supprimer ce parcours</button>
        </div>
        <hr class="mt-4">
    </div>
</template>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const addMilitaryPathBtn = document.getElementById('add-military-path-btn');
    const militaryPathsContainer = document.getElementById('military-paths-container');
    const militaryTemplate = document.getElementById('military-template');

    // Ajout dynamique des parcours militaires
    addMilitaryPathBtn.addEventListener('click', () => {
        const templateContent = militaryTemplate.content.cloneNode(true);
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

        militaryPathsContainer.appendChild(templateContent);
        cleanTextareaInput(`academy_diploma_${timestamp}`);
    });

    // Suppression dynamique des parcours militaires
    militaryPathsContainer.addEventListener('click', (event) => {
        if (event.target.classList.contains('remove-military-path-btn')) {
            const militaryPath = event.target.closest('.military-path');
            if (militaryPath) {
                militaryPath.remove();
            }
        }
    });
});
</script>
