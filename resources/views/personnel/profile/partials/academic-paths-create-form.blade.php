<section id="academic-paths-container" style="display: none;">
    <div class="academic-path pb-4 row g-3">
        <!-- School name -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="school_name" :value="__('Etablissement fréquenté')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Ecole, collège, lycée, institut, université ..." role="img" aria-label="Ecole, collège, lycée, institut, université ..."></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="school_name" name="school_name[]" type="text" placeholder="Entrer nom de l'établissement fréquenté" class="{{ $errors->has('school_name[]') ? 'is-invalid' : '' }}" :value="old('school_name[]')" />
            <x-input-error class="mt-2" :messages="$errors->get('school_name[]')" />
        </div>

        <!-- Duration -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="duration" :value="__('Période')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Période" role="img" aria-label="Période"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="duration" name="duration[]" type="text" placeholder="Entrer période" class="{{ $errors->has('duration[]') ? 'is-invalid' : '' }}" :value="old('duration[]')" />
            <x-input-error class="mt-2" :messages="$errors->get('duration[]')" />
        </div>

        <!-- Diploma -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="diploma" :value="__('Sanctions')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Sanctions d'études" role="img" aria-label="Sanctions d'études"></i>
        </div>
        <div class="col-md-7">
            <x-textarea-input id="diploma" name="diploma[]" rows="3" class="{{ $errors->has('diploma[]') ? 'is-invalid' : '' }}" placeholder="Entrer diplômes, certificats ou attestations obtenus">{{ old('diploma[]') }}</x-textarea-input>
            <x-input-error class="mt-2" :messages="$errors->get('diploma[]')" />
        </div>

        <!-- Remove button -->
        <div class="col-md-12 text-end mt-3">
            <span type="button" class="btn btn-danger remove-academic-btn" style="display: none;">Supprimer ce parcours</span>
        </div>

        <hr class="mt-4">
    </div>
</section>

<div class="py-2 text-end">
    <span id="add-first-academic-btn" class="btn btn-primary">Ajouter un parcours</span>
    <span id="add-academic-btn" class="btn btn-primary" style="display: none;">Ajouter un autre parcours</span>
</div>


<script>
    const academicContainer = document.getElementById('academic-paths-container');
    const addFirstacademicBtn = document.getElementById('add-first-academic-btn');
    const addacademicBtn = document.getElementById('add-academic-btn');

    addFirstacademicBtn.addEventListener('click', () => {
        academicContainer.style.display = 'block';
        addFirstacademicBtn.style.display = 'none';
        addacademicBtn.style.display = 'inline-block';

        const firstRemoveBtn = document.querySelector('.academic-path .remove-academic-btn');
        if (firstRemoveBtn) {
            firstRemoveBtn.style.display = 'inline-block';
            firstRemoveBtn.addEventListener('click', handleRemoveacademic);
        }
    });

    addacademicBtn.addEventListener('click', () => {
        const template = document.querySelector('.academic-path');
        const clone = template.cloneNode(true);

        const timestamp = Date.now();
        clone.querySelectorAll('[id]').forEach(element => {
            const newId = `${element.id}_${timestamp}`;
            clone.querySelector(`label[for="${element.id}"]`)?.setAttribute('for', newId);
            element.id = newId;

            // Réinitialiser les valeurs des champs
            if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA') {
                element.value = '';
            } else if (element.tagName === 'SELECT') {
                element.selectedIndex = 0;
            }
        });

        const removeBtn = clone.querySelector('.remove-academic-btn');
        if (removeBtn) {
            removeBtn.style.display = 'inline-block';
            removeBtn.addEventListener('click', handleRemoveacademic);
        }

        academicContainer.appendChild(clone);
    });

    function handleRemoveacademic(event) {
        const childPath = event.target.closest('.academic-path');
        const allPaths = academicContainer.querySelectorAll('.academic-path');

        if (allPaths.length === 1) {
            // Si c'est la dernière section, on la réinitialise et on la masque
            childPath.querySelectorAll('input, textarea, select').forEach(element => {
                if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA') {
                    element.value = '';
                } else if (element.tagName === 'SELECT') {
                    element.selectedIndex = 0;
                }
            });
            academicContainer.style.display = 'none';
            addFirstacademicBtn.style.display = 'inline-block';
            addacademicBtn.style.display = 'none';
        } else {
            // Sinon, on la supprime
            childPath.remove();
        }
    }
</script>

