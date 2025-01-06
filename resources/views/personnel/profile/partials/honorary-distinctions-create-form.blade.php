<section id="honorary-distinctions-container" style="display: none;">
    <div class="honorary-distinction pb-4 row g-3">
        <!-- Title -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="honorary_title" :value="__('Intitulé')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Décoration" role="img" aria-label="Décoration"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="honorary_title" name="honorary_title[]" type="text" placeholder="Entrer intitulé distinction" class="{{ $errors->has('honorary_title.*') ? 'is-invalid' : '' }}" />
            <x-input-error class="mt-2" :messages="$errors->get('honorary_title.*')" />
        </div>

        <!-- Promotion -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="honorary_promotion" :value="__('Promotion')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Promotion" role="img" aria-label="Promotion"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="honorary_promotion" name="honorary_promotion[]" type="text" placeholder="Entrer promotion" class="{{ $errors->has('honorary_promotion.*') ? 'is-invalid' : '' }}" />
            <x-input-error class="mt-2" :messages="$errors->get('honorary_promotion.*')" />
        </div>

        <!-- Description -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="honorary_reference" :value="__('Référence')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Référence" role="img" aria-label="Référence"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="honorary_reference" name="honorary_reference[]" type="text" placeholder="Entrer référence" class="{{ $errors->has('honorary_reference.*') ? 'is-invalid' : '' }}" />
            <x-input-error class="mt-2" :messages="$errors->get('honorary_reference.*')" />
        </div>

        <!-- Remove button -->
        <div class="col-md-12 text-end mt-3">
            <span type="button" class="btn btn-danger remove-honorary-btn" style="display: none;">Supprimer cette distinction</span>
        </div>

        <hr class="mt-4">
    </div>
</section>

<div class="py-2 text-end">
    <span id="add-first-honorary-btn" class="btn btn-primary">Ajouter une distinction</span>
    <span id="add-honorary-btn" class="btn btn-primary" style="display: none;">Ajouter une autre distinction</span>
</div>


<script>
    const honoraryContainer = document.getElementById('honorary-distinctions-container');
    const addFirsthonoraryBtn = document.getElementById('add-first-honorary-btn');
    const addhonoraryBtn = document.getElementById('add-honorary-btn');

    addFirsthonoraryBtn.addEventListener('click', () => {
        honoraryContainer.style.display = 'block';
        addFirsthonoraryBtn.style.display = 'none';
        addhonoraryBtn.style.display = 'inline-block';

        const firstRemoveBtn = document.querySelector('.honorary-distinction .remove-honorary-btn');
        if (firstRemoveBtn) {
            firstRemoveBtn.style.display = 'inline-block';
            firstRemoveBtn.addEventListener('click', handleRemovehonorary);
        }
    });

    addhonoraryBtn.addEventListener('click', () => {
        const template = document.querySelector('.honorary-distinction');
        const clone = template.cloneNode(true);

        const timestamp = Date.now();
        clone.querySelectorAll('[id]').forEach(input => {
            const newId = `${input.id}_${timestamp}`;
            clone.querySelector(`label[for="${input.id}"]`)?.setAttribute('for', newId);
            input.id = newId;
            input.value = '';
        });

        const removeBtn = clone.querySelector('.remove-honorary-btn');
        if (removeBtn) {
            removeBtn.style.display = 'inline-block';
            removeBtn.addEventListener('click', handleRemovehonorary);
        }

        honoraryContainer.appendChild(clone);
    });

    function handleRemovehonorary(event) {
        const childdistinction = event.target.closest('.honorary-distinction');
        const alldistinctions = honoraryContainer.querySelectorAll('.honorary-distinction');

        if (alldistinctions.length === 1) {
            // Si c'est la dernière section, on la réinitialise et on la masque
            childdistinction.querySelectorAll('input, select').forEach(input => (input.value = ''));
            honoraryContainer.style.display = 'none';
            addFirsthonoraryBtn.style.display = 'inline-block';
            addhonoraryBtn.style.display = 'none';
        } else {
            // Sinon, on la supprime
            childdistinction.remove();
        }
    }
</script>
