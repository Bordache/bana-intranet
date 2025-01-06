<section id="military-campaigns-container" style="display: none;">
    <div class="military-campaign pb-4 row g-3">
        <!-- Title -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="campaign_title" :value="__('Intitulé')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Campagne" role="img" aria-label="Campagne"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="campaign_title" name="campaign_title[]" type="text" placeholder="Entrer une opération ou une manoeuvre" class="{{ $errors->has('campaign_title[]') ? 'is-invalid' : '' }}" />
            <x-input-error class="mt-2" :messages="$errors->get('campaign_title[]')" />
        </div>

        <!-- Period -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="campaign_period" :value="__('Période')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Période" role="img" aria-label="Période"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="campaign_period" name="campaign_period[]" type="text" placeholder="Entrer période" class="{{ $errors->has('campaign_period[]') ? 'is-invalid' : '' }}" />
            <x-input-error class="mt-2" :messages="$errors->get('campaign_period[]')" />
        </div>

        <!-- Location -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="campaign_locations" :value="__('Lieu')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu" role="img" aria-label="Lieu"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-textarea-input id="campaign_locations" name="campaign_locations[]" rows="3" class="{{ $errors->has('campaign_locations[]') ? 'is-invalid' : '' }}" placeholder="Entrer lieu(x)">{{ old('campaign_locations[]') }}</x-textarea-input>
            <x-input-error class="mt-2" :messages="$errors->get('campaign_locations[]')" />
        </div>

        <!-- Remove button -->
        <div class="col-md-12 text-end mt-3">
            <span type="button" class="btn btn-danger remove-military-btn" style="display: none;">Supprimer cette campagne</span>
        </div>

        <hr class="mt-4">
    </div>
</section>

<div class="py-2 text-end">
    <span id="add-first-campaign-btn" class="btn btn-primary">Ajouter une campagne</span>
    <span id="add-campaign-btn" class="btn btn-primary" style="display: none;">Ajouter une autre campagne</span>
</div>


<script>
    const campaignContainer = document.getElementById('military-campaigns-container');
    const addFirstcampaignBtn = document.getElementById('add-first-campaign-btn');
    const addcampaignBtn = document.getElementById('add-campaign-btn');

    addFirstcampaignBtn.addEventListener('click', () => {
        campaignContainer.style.display = 'block';
        addFirstcampaignBtn.style.display = 'none';
        addcampaignBtn.style.display = 'inline-block';

        const firstRemoveBtn = document.querySelector('.military-campaign .remove-military-btn');
        if (firstRemoveBtn) {
            firstRemoveBtn.style.display = 'inline-block';
            firstRemoveBtn.addEventListener('click', handleRemovemilitary);
        }
    });

    addcampaignBtn.addEventListener('click', () => {
        const template = document.querySelector('.military-campaign');
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

        campaignContainer.appendChild(clone);
    });

    function handleRemovemilitary(event) {
        const childcampaign = event.target.closest('.military-campaign');
        const allcampaigns = campaignContainer.querySelectorAll('.military-campaign');

        if (allcampaigns.length === 1) {
            // Si c'est la dernière section, on la réinitialise et on la masque
            childcampaign.querySelectorAll('input, select').forEach(input => (input.value = ''));
            campaignContainer.style.display = 'none';
            addFirstcampaignBtn.style.display = 'inline-block';
            addcampaignBtn.style.display = 'none';
        } else {
            // Sinon, on la supprime
            childcampaign.remove();
        }
    }
</script>
