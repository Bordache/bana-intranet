<section id="career-paths-container" style="display: none;">
    <div class="career-path pb-4 row g-3">
        <!-- Company -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="company_name" :value="__('Lieu d\'emploi')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu d\'affectation" role="img" aria-label="Lieu d\'affectation"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="company_name" name="company_name[]" type="text" placeholder="Entrer lieu d'emploi" class="{{ $errors->has('company_name[]') ? 'is-invalid' : '' }}" />
            <x-input-error class="mt-2" :messages="$errors->get('company_name[]')" />
        </div>

        <!-- Job title -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="job_title" :value="__('Fonction ou emploi tenu')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Fonction ou emploi tenu" role="img" aria-label="Fonction ou emploi tenu"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="job_title" name="job_title[]" type="text" placeholder="Entrer fonction ou emploi" class="{{ $errors->has('job_title[]') ? 'is-invalid' : '' }}" />
            <x-input-error class="mt-2" :messages="$errors->get('job_title[]')" />
        </div>

        <!-- Start date -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="start_date" :value="__('Début d\'affectation')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de début d'affectation" role="img" aria-label="Date de début d'affectation"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="start_date" name="start_date[]" type="date" class="{{ $errors->has('start_date[]') ? 'is-invalid' : '' }}" />
            <x-input-error class="mt-2" :messages="$errors->get('start_date[]')" />
        </div>

        <!-- End date -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="end_date" :value="__('Fin d\'affectation')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Date de fin d'affectation" role="img" aria-label="Date de fin d'affectation"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="end_date" name="end_date[]" type="date" class="{{ $errors->has('end_date[]') ? 'is-invalid' : '' }}" />
            <x-input-error class="mt-2" :messages="$errors->get('end_date[]')" />
        </div>

        <!-- Description -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="description" :value="__('Référence')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Décision ou décret" role="img" aria-label="Décision ou décret"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="description" name="description[]" type="text" placeholder="Entrer décision ou décret" class="{{ $errors->has('description[]') ? 'is-invalid' : '' }}" />
            <x-input-error class="mt-2" :messages="$errors->get('description[]')" />
        </div>

        <!-- Remove button -->
        <div class="col-md-12 text-end mt-3">
            <span type="button" class="btn btn-danger remove-career-btn" style="display: none;">Supprimer ce parcours</span>
        </div>

        <hr class="mt-4">
    </div>
</section>

<div class="py-2 text-end">
    <span id="add-first-career-btn" class="btn btn-primary">Ajouter un parcours</span>
    <span id="add-career-btn" class="btn btn-primary" style="display: none;">Ajouter un autre parcours</span>
</div>


<script>
    const careerContainer = document.getElementById('career-paths-container');
    const addFirstCareerBtn = document.getElementById('add-first-career-btn');
    const addCareerBtn = document.getElementById('add-career-btn');

    addFirstCareerBtn.addEventListener('click', () => {
        careerContainer.style.display = 'block';
        addFirstCareerBtn.style.display = 'none';
        addCareerBtn.style.display = 'inline-block';

        const firstRemoveBtn = document.querySelector('.career-path .remove-career-btn');
        if (firstRemoveBtn) {
            firstRemoveBtn.style.display = 'inline-block';
            firstRemoveBtn.addEventListener('click', handleRemoveCareer);
        }
    });

    addCareerBtn.addEventListener('click', () => {
        const template = document.querySelector('.career-path');
        const clone = template.cloneNode(true);

        const timestamp = Date.now();
        clone.querySelectorAll('[id]').forEach(input => {
            const newId = `${input.id}_${timestamp}`;
            clone.querySelector(`label[for="${input.id}"]`)?.setAttribute('for', newId);
            input.id = newId;
            input.value = '';
        });

        const removeBtn = clone.querySelector('.remove-career-btn');
        if (removeBtn) {
            removeBtn.style.display = 'inline-block';
            removeBtn.addEventListener('click', handleRemoveCareer);
        }

        careerContainer.appendChild(clone);
    });

    function handleRemoveCareer(event) {
        const childPath = event.target.closest('.career-path');
        const allPaths = careerContainer.querySelectorAll('.career-path');

        if (allPaths.length === 1) {
            // Si c'est la dernière section, on la réinitialise et on la masque
            childPath.querySelectorAll('input, select').forEach(input => (input.value = ''));
            careerContainer.style.display = 'none';
            addFirstCareerBtn.style.display = 'inline-block';
            addCareerBtn.style.display = 'none';
        } else {
            // Sinon, on la supprime
            childPath.remove();
        }
    }
</script>
