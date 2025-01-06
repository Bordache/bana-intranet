<section id="military-paths-container" style="display: none;">
    <div class="military-path pb-4 row g-3">
        <!-- Academy name -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="academy_name" :value="__('Centre ou école')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Centre ou école fréquenté" role="img" aria-label="Centre ou école fréquenté"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="academy_name" name="academy_name[]" type="text" placeholder="Entrer nom du centre ou école fréquenté" class="{{ $errors->has('academy_name.*') ? 'is-invalid' : '' }}" />
            <x-input-error class="mt-2" :messages="$errors->get('academy_name.*')" />
        </div>

        <!-- Duration -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="academy_duration" :value="__('Période')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Période" role="img" aria-label="Période"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="academy_duration" name="academy_duration[]" type="text" placeholder="Entrer période" class="{{ $errors->has('academy_duration.*') ? 'is-invalid' : '' }}" />
            <x-input-error class="mt-2" :messages="$errors->get('academy_duration.*')" />
        </div>

        <!-- Diploma -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="academy_diploma" :value="__('Sanctions')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Sanctions de stage ou de formation" role="img" aria-label="Sanctions de stage ou de formation"></i>
        </div>
        <div class="col-md-7">
            <x-textarea-input id="academy_diploma" name="academy_diploma[]" rows="3" class="{{ $errors->has('academy_diploma.*') ? 'is-invalid' : '' }}" placeholder="Entrer diplômes, certificats ou attestations obtenus">{{ old('academy_diploma') }}</x-textarea-input>
            <x-input-error class="mt-2" :messages="$errors->get('academy_diploma.*')" />
        </div>

        <!-- Remove button -->
        <div class="col-md-12 text-end mt-3">
            <span type="button" class="btn btn-danger remove-military-btn" style="display: none;">Supprimer ce parcours</span>
        </div>

        <hr class="mt-4">
    </div>
</section>

<div class="py-2 text-end">
    <span id="add-first-military-btn" class="btn btn-primary">Ajouter un parcours</span>
    <span id="add-military-btn" class="btn btn-primary" style="display: none;">Ajouter un autre parcours</span>
</div>


<script>
    const militaryContainer = document.getElementById('military-paths-container');
    const addFirstmilitaryBtn = document.getElementById('add-first-military-btn');
    const addmilitaryBtn = document.getElementById('add-military-btn');

    addFirstmilitaryBtn.addEventListener('click', () => {
        militaryContainer.style.display = 'block';
        addFirstmilitaryBtn.style.display = 'none';
        addmilitaryBtn.style.display = 'inline-block';

        const firstRemoveBtn = document.querySelector('.military-path .remove-military-btn');
        if (firstRemoveBtn) {
            firstRemoveBtn.style.display = 'inline-block';
            firstRemoveBtn.addEventListener('click', handleRemovemilitary);
        }
    });

    addmilitaryBtn.addEventListener('click', () => {
        const template = document.querySelector('.military-path');
        const clone = template.cloneNode(true);

        const timestamp = Date.now();
        clone.querySelectorAll('[id]').forEach(input => {
            const newId = `${input.id}_${timestamp}`;
            clone.querySelector(`label[for="${input.id}"]`)?.setAttribute('for', newId);
            input.id = newId;
            input.value = '';
        });

        const removeBtn = clone.querySelector('.remove-military-btn');
        if (removeBtn) {
            removeBtn.style.display = 'inline-block';
            removeBtn.addEventListener('click', handleRemovemilitary);
        }

        militaryContainer.appendChild(clone);
    });

    function handleRemovemilitary(event) {
        const childPath = event.target.closest('.military-path');
        const allPaths = militaryContainer.querySelectorAll('.military-path');

        if (allPaths.length === 1) {
            // Si c'est la dernière section, on la réinitialise et on la masque
            childPath.querySelectorAll('input, select').forEach(input => (input.value = ''));
            militaryContainer.style.display = 'none';
            addFirstmilitaryBtn.style.display = 'inline-block';
            addmilitaryBtn.style.display = 'none';
        } else {
            // Sinon, on la supprime
            childPath.remove();
        }
    }
</script>
