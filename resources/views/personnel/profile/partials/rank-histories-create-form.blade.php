<section id="rank-histories-container" style="display: none;">
    <div class="rank-history pb-4 row g-3">
        <!-- Rank -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="history_rank" :value="__('Grade')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Rang militaire" role="img" aria-label="Rang militaire"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-select-input id="history_rank" name="history_rank[]" class="{{ $errors->has('history_rank[]') ? 'is-invalid' : '' }}" >
                <option value="" disabled {{ old('history_rank[]') == null ? 'selected' : '' }} >Choisir à la selection</option>
                @foreach($ranks as $rank)
                    <option value="{{ $rank->abbreviate }}" {{ old('history_rank[]') == $rank->abbreviate ? 'selected' : '' }} title="{{ $rank->abbreviate }}" >{{ $rank->name }}</option>
                @endforeach
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('history_rank[]')" />
        </div>

        <!-- Rank date -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="history_promotion_date" :value="__('Date d\'effet')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Pour compter de" role="img" aria-label="Pour compter de"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="history_promotion_date" name="history_promotion_date[]" type="date" class="{{ $errors->has('history_promotion_date[]') ? 'is-invalid' : '' }}" />
            <x-input-error class="mt-2" :messages="$errors->get('history_promotion_date[]')" />
        </div>

        <!-- Reference -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="history_rank_reference" :value="__('Référence')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Décision ou décret" role="img" aria-label="Décision ou décret"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="history_rank_reference" name="history_rank_reference[]" type="text" placeholder="Entrer décision ou décret" class="{{ $errors->has('history_rank_reference[]') ? 'is-invalid' : '' }}" />
            <x-input-error class="mt-2" :messages="$errors->get('history_rank_reference[]')" />
        </div>

        <!-- Remove button -->
        <div class="col-md-12 text-end mt-3">
            <span type="button" class="btn btn-danger remove-rank-btn" style="display: none;">Supprimer ce grade</span>
        </div>

        <hr class="mt-4">
    </div>
</section>

<div class="py-2 text-end">
    <span id="add-first-rank-btn" class="btn btn-primary">Ajouter un grade</span>
    <span id="add-rank-btn" class="btn btn-primary" style="display: none;">Ajouter un autre grade</span>
</div>


<script>
    const rankContainer = document.getElementById('rank-histories-container');
    const addFirstrankBtn = document.getElementById('add-first-rank-btn');
    const addrankBtn = document.getElementById('add-rank-btn');

    addFirstrankBtn.addEventListener('click', () => {
        rankContainer.style.display = 'block';
        addFirstrankBtn.style.display = 'none';
        addrankBtn.style.display = 'inline-block';

        const firstRemoveBtn = document.querySelector('.rank-history .remove-rank-btn');
        if (firstRemoveBtn) {
            firstRemoveBtn.style.display = 'inline-block';
            firstRemoveBtn.addEventListener('click', handleRemoverank);
        }
    });

    addrankBtn.addEventListener('click', () => {
        const template = document.querySelector('.rank-history');
        const clone = template.cloneNode(true);

        const timestamp = Date.now();
        clone.querySelectorAll('[id]').forEach(input => {
            const newId = `${input.id}_${timestamp}`;
            clone.querySelector(`label[for="${input.id}"]`)?.setAttribute('for', newId);
            input.id = newId;
            input.value = '';
        });

        const removeBtn = clone.querySelector('.remove-rank-btn');
        if (removeBtn) {
            removeBtn.style.display = 'inline-block';
            removeBtn.addEventListener('click', handleRemoverank);
        }

        rankContainer.appendChild(clone);
    });

    function handleRemoverank(event) {
        const childhistory = event.target.closest('.rank-history');
        const allhistories = rankContainer.querySelectorAll('.rank-history');

        if (allhistories.length === 1) {
            // Si c'est la dernière section, on la réinitialise et on la masque
            childhistory.querySelectorAll('input, select').forEach(input => (input.value = ''));
            rankContainer.style.display = 'none';
            addFirstrankBtn.style.display = 'inline-block';
            addrankBtn.style.display = 'none';
        } else {
            // Sinon, on la supprime
            childhistory.remove();
        }
    }
</script>
