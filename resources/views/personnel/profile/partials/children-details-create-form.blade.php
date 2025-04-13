<!-- Conteneur des sections enfants -->
<div id="children-paths-container">
    @if (old('child_full_name'))
        @foreach (old('child_full_name') as $index => $fullName)
            <div class="children-path pb-4 row g-3">

                <!-- Nom complet -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="child_full_name_{{ $index }}" :value="__('Nom et prénom(s)')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Nom et prénoms" role="img" aria-label="Nom et prénoms"></i>
                    <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="child_full_name_{{ $index }}" name="child_full_name[]" type="text"
                                  placeholder="Entrer nom et prénoms"
                                  value="{{ $fullName }}"
                                  class="{{ $errors->has('child_full_name.' . $index) ? 'is-invalid' : '' }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('child_full_name.' . $index)" />
                </div>

                <!-- Date de naissance -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="child_birth_date_{{ $index }}" :value="__('Date de naissance')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de naissance" role="img" aria-label="Date de naissance"></i>
                    <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="child_birth_date_{{ $index }}" name="child_birth_date[]" type="date"
                                  value="{{ old('child_birth_date.' . $index) }}"
                                  class="{{ $errors->has('child_birth_date.' . $index) ? 'is-invalid' : '' }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('child_birth_date.' . $index)" />
                </div>

                <!-- Lieu de naissance -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="child_birth_place_{{ $index }}" :value="__('Lieu de naissance')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu de naissance" role="img" aria-label="Lieu de naissance"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="child_birth_place_{{ $index }}" name="child_birth_place[]" type="text"
                                  placeholder="Entrer lieu de naissance"
                                  value="{{ old('child_birth_place.' . $index) }}"
                                  class="{{ $errors->has('child_birth_place.' . $index) ? 'is-invalid' : '' }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('child_birth_place.' . $index)" />
                </div>

                <!-- Genre -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="child_gender_{{ $index }}" :value="__('Genre')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Genre" role="img" aria-label="Genre"></i>
                    <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                </div>
                <div class="col-md-7">
                    <x-select-input id="child_gender_{{ $index }}" name="child_gender[]"
                                    class="{{ $errors->has('child_gender.' . $index) ? 'is-invalid' : '' }}">
                        <option value="">{{ __('Choisir à la sélection') }}</option>
                        <option value="Masculin" {{ old('child_gender.' . $index) == 'Masculin' ? 'selected' : '' }}>{{ __('Masculin') }}</option>
                        <option value="Féminin" {{ old('child_gender.' . $index) == 'Féminin' ? 'selected' : '' }}>{{ __('Féminin') }}</option>
                    </x-select-input>
                    <x-input-error class="mt-2" :messages="$errors->get('child_gender.' . $index)" />
                </div>

                <!-- Statut de l'enfant -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="child_status_{{ $index }}" :value="__('Situation de l\'enfant')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Statut de l'enfant" role="img" aria-label="Statut de l'enfant"></i>
                </div>
                <div class="col-md-7">
                    <x-select-input id="child_status_{{ $index }}" name="child_status[]"
                                    class="{{ $errors->has('child_status.' . $index) ? 'is-invalid' : '' }}">
                        <option value="">{{ __('Choisir à la sélection') }}</option>
                        <option value="Légitime" {{ old('child_status.' . $index) == 'Légitime' ? 'selected' : '' }}>{{ __('Légitime') }}</option>
                        <option value="Reconnu" {{ old('child_status.' . $index) == 'Reconnu' ? 'selected' : '' }}>{{ __('Reconnu') }}</option>
                        <option value="Adopté" {{ old('child_status.' . $index) == 'Adopté' ? 'selected' : '' }}>{{ __('Adopté') }}</option>
                        <option value="Non légitime" {{ old('child_status.' . $index) == 'Non légitime' ? 'selected' : '' }}>{{ __('Non légitime') }}</option>
                    </x-select-input>
                    <x-input-error class="mt-2" :messages="$errors->get('child_status.' . $index)" />
                </div>

                <div class="col-md-12 text-end mt-3">
                    <button type="button" class="btn btn-danger remove-child-btn">Supprimer cet enfant</button>
                </div>
                <hr class="mt-4">
            </div>
        @endforeach
    @endif
</div>

<!-- Bouton "Ajouter enfant" -->
<div class="mb-3 text-end">
    <button id="add-child-btn" type="button" class="btn btn-primary">Ajouter enfant</button>
</div>

<!-- Template pour les sections enfants -->
<template id="child-template">
    <div class="children-path pb-4 row g-3">
        <!-- Nom complet -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="child_full_name" :value="__('Nom et prénom(s)')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Nom et prénoms" role="img" aria-label="Nom et prénoms"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="child_full_name" name="child_full_name[]" type="text"
                          placeholder="Entrer nom et prénoms" />
        </div>

        <!-- Date de naissance -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="child_birth_date" :value="__('Date de naissance')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de naissance" role="img" aria-label="Date de naissance"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="child_birth_date" name="child_birth_date[]" type="date" />
        </div>

        <!-- Lieu de naissance -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="child_birth_place" :value="__('Lieu de naissance')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu de naissance" role="img" aria-label="Lieu de naissance"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="child_birth_place" name="child_birth_place[]" type="text"
                          placeholder="Entrer lieu de naissance" />
        </div>

        <!-- Genre -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="child_gender" :value="__('Genre')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Genre" role="img" aria-label="Genre"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-select-input id="child_gender" name="child_gender[]">
                <option value="">{{ __('Choisir à la sélection') }}</option>
                <option value="Masculin">{{ __('Masculin') }}</option>
                <option value="Féminin">{{ __('Féminin') }}</option>
            </x-select-input>
        </div>

        <!-- Statut de l'enfant -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="child_status" :value="__('Situation de l\'enfant')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Statut de l'enfant" role="img" aria-label="Statut de l'enfant"></i>
        </div>
        <div class="col-md-7">
            <x-select-input id="child_status" name="child_status[]">
                <option value="">{{ __('Choisir à la sélection') }}</option>
                <option value="Légitime">{{ __('Légitime') }}</option>
                <option value="Reconnu">{{ __('Reconnu') }}</option>
                <option value="Adopté">{{ __('Adopté') }}</option>
                <option value="Non légitime">{{ __('Non légitime') }}</option>
            </x-select-input>
        </div>

        <div class="col-md-12 text-end mt-3">
            <button type="button" class="btn btn-danger remove-child-btn">Supprimer cet enfant</button>
        </div>
        <hr class="mt-4">
    </div>
</template>


<!-- JavaScript -->

<script>
document.addEventListener('DOMContentLoaded', () => {
    const addChildBtn = document.getElementById('add-child-btn');
    const childrenContainer = document.getElementById('children-paths-container');
    const childTemplate = document.getElementById('child-template');

    // Ajout dynamique des sections enfants
    addChildBtn.addEventListener('click', () => {
        const templateContent = childTemplate.content.cloneNode(true);
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

        childrenContainer.appendChild(templateContent);
    });

    // Suppression dynamique des sections enfants
    childrenContainer.addEventListener('click', (event) => {
        if (event.target.classList.contains('remove-child-btn')) {
            const childPath = event.target.closest('.children-path');
            if (childPath) {
                childPath.remove();
            }
        }
    });
});
</script>
