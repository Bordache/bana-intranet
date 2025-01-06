<section id="children-paths-container" style="display: none;">
    <div class="children-path pb-4 row g-3">
        <!-- Full name -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="child_full_name" :value="__('Nom et prénom(s)')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Nom et prénoms" role="img" aria-label="Nom et prénoms"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="child_full_name" name="child_full_name[]" type="text" placeholder="Entrer nom et prénoms" class="{{ $errors->has('child_full_name.*') ? 'is-invalid' : '' }}" />
            <x-input-error class="mt-2" :messages="$errors->get('child_full_name.*')" />
        </div>

        <!-- Birth Date -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="child_birth_date" :value="__('Date de naissance')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de naissance" role="img" aria-label="Date de naissance"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="child_birth_date" name="child_birth_date[]" type="date" class="{{ $errors->has('child_birth_date.*') ? 'is-invalid' : '' }}" />
            <x-input-error class="mt-2" :messages="$errors->get('child_birth_date.*')" />
        </div>

        <!-- Birth Place -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="child_birth_place" :value="__('Lieu de naissance')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu de naissance" role="img" aria-label="Lieu de naissance"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="child_birth_place" name="child_birth_place[]" type="text" placeholder="Entrer lieu de naissance" />
            <x-input-error class="mt-2" :messages="$errors->get('child_birth_place.*')" />
        </div>

        <!-- Gender -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="child_gender" :value="__('Genre')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Genre" role="img" aria-label="Genre"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-select-input id="child_gender" name="child_gender[]" class="{{ $errors->has('child_gender.*') ? 'is-invalid' : '' }}">
                <option value="">{{ __('Choisir à la selection') }}</option>
                <option value="M">{{ __('Masculin') }}</option>
                <option value="F">{{ __('Féminin') }}</option>
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('child_gender.*')" />
        </div>

        <!-- Child status -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="child_status" :value="__('Statut de l\'enfant')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Statut de l'enfant" role="img" aria-label="Statut de l'enfant"></i>
        </div>
        <div class="col-md-7">
            <x-select-input id="child_status" name="child_status[]">
                <option value="">{{ __('Choisir à la selection') }}</option>
                <option value="LG">{{ __('Légitime') }}</option>
                <option value="RE">{{ __('Reconnu') }}</option>
                <option value="AD">{{ __('Adopté') }}</option>
                <option value="NL">{{ __('Non-légitime') }}</option>
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('child_status.*')" />
        </div>

        <!-- Remove button -->
        <div class="col-md-12 text-end mt-3">
            <span type="button" class="btn btn-danger remove-child-btn" style="display: none;">Supprimer cet enfant</span>
        </div>

        <hr class="mt-4">
    </div>
</section>

<div class="py-2 text-end">
    <span id="add-first-child-btn" class="btn btn-primary">Ajouter un enfant</span>
    <span id="add-child-btn" class="btn btn-primary" style="display: none;">Ajouter un autre enfant</span>
</div>


<script>
    const container = document.getElementById('children-paths-container');
    const addFirstChildBtn = document.getElementById('add-first-child-btn');
    const addChildBtn = document.getElementById('add-child-btn');

    addFirstChildBtn.addEventListener('click', () => {
        container.style.display = 'block';
        addFirstChildBtn.style.display = 'none';
        addChildBtn.style.display = 'inline-block';

        const firstRemoveBtn = document.querySelector('.children-path .remove-child-btn');
        if (firstRemoveBtn) {
            firstRemoveBtn.style.display = 'inline-block';
            firstRemoveBtn.addEventListener('click', handleRemoveChild);
        }
    });

    addChildBtn.addEventListener('click', () => {
        const template = document.querySelector('.children-path');
        const clone = template.cloneNode(true);

        const timestamp = Date.now();
        clone.querySelectorAll('[id]').forEach(input => {
            const newId = `${input.id}_${timestamp}`;
            clone.querySelector(`label[for="${input.id}"]`)?.setAttribute('for', newId);
            input.id = newId;
            input.value = '';
        });

        const removeBtn = clone.querySelector('.remove-child-btn');
        if (removeBtn) {
            removeBtn.style.display = 'inline-block';
            removeBtn.addEventListener('click', handleRemoveChild);
        }

        container.appendChild(clone);
    });

    function handleRemoveChild(event) {
        const childPath = event.target.closest('.children-path');
        const allPaths = container.querySelectorAll('.children-path');

        if (allPaths.length === 1) {
            // Si c'est la dernière section, on la réinitialise et on la masque
            childPath.querySelectorAll('input, select').forEach(input => (input.value = ''));
            container.style.display = 'none';
            addFirstChildBtn.style.display = 'inline-block';
            addChildBtn.style.display = 'none';
        } else {
            // Sinon, on la supprime
            childPath.remove();
        }
    }
</script>
