<!-- Conteneur des campagnes militaires -->
<section id="military-campaigns-container">
    @if (old('campaign_title'))
        @foreach (old('campaign_title') as $index => $campaignTitle)
            <div class="military-campaign pb-4 row g-3">

                <!-- Intitulé -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="campaign_title_{{ $index }}" :value="__('Intitulé')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Campagne" role="img" aria-label="Campagne"></i>
                    <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="campaign_title_{{ $index }}" name="campaign_title[]" type="text"
                                  placeholder="Entrer une opération ou une manœuvre"
                                  value="{{ $campaignTitle }}"
                                  class="{{ $errors->has('campaign_title.' . $index) ? 'is-invalid' : '' }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('campaign_title.' . $index)" />
                </div>

                <!-- Période -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="campaign_period_{{ $index }}" :value="__('Période')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Période" role="img" aria-label="Période"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="campaign_period_{{ $index }}" name="campaign_period[]" type="text"
                                  placeholder="Entrer période"
                                  value="{{ old('campaign_period.' . $index) }}"
                                  class="{{ $errors->has('campaign_period.' . $index) ? 'is-invalid' : '' }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('campaign_period.' . $index)" />
                </div>

                <!-- Lieu -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="campaign_locations_{{ $index }}" :value="__('Lieu')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu" role="img" aria-label="Lieu"></i>
                </div>
                <div class="col-md-7">
                    <x-textarea-input id="campaign_locations_{{ $index }}" name="campaign_locations[]" rows="3"
                                      placeholder="Entrer lieu(x)"
                                      class="{{ $errors->has('campaign_locations.' . $index) ? 'is-invalid' : '' }}">{{ old('campaign_locations.' . $index) }}</x-textarea-input>
                    <x-input-error class="mt-2" :messages="$errors->get('campaign_locations.' . $index)" />
                </div>

                <div class="col-md-12 text-end mt-3">
                    <button type="button" class="btn btn-danger remove-military-campaign-btn">Supprimer cette campagne</button>
                </div>
                <hr class="mt-4">
            </div>
        @endforeach
    @endif
</section>

<!-- Bouton "Ajouter campagne militaire" -->
<div class="mb-3 text-end">
    <button id="add-military-campaign-btn" type="button" class="btn btn-primary">Ajouter campagne militaire</button>
</div>

<!-- Template pour les campagnes militaires -->
<template id="military-campaign-template">
    <div class="military-campaign pb-4 row g-3">
        <!-- Intitulé -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="campaign_title" :value="__('Intitulé')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Campagne" role="img" aria-label="Campagne"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="campaign_title" name="campaign_title[]" type="text" placeholder="Entrer une opération ou une manœuvre" />
        </div>

        <!-- Période -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="campaign_period" :value="__('Période')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Période" role="img" aria-label="Période"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="campaign_period" name="campaign_period[]" type="text" placeholder="Entrer période" />
        </div>

        <!-- Lieu -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="campaign_locations" :value="__('Lieu')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Lieu" role="img" aria-label="Lieu"></i>
        </div>
        <div class="col-md-7">
            <x-textarea-input id="campaign_locations" name="campaign_locations[]" rows="3" placeholder="Entrer lieu(x)"></x-textarea-input>
        </div>

        <div class="col-md-12 text-end mt-3">
            <button type="button" class="btn btn-danger remove-military-campaign-btn">Supprimer cette campagne</button>
        </div>
        <hr class="mt-4">
    </div>
</template>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const addMilitaryCampaignBtn = document.getElementById('add-military-campaign-btn');
    const militaryCampaignsContainer = document.getElementById('military-campaigns-container');
    const militaryCampaignTemplate = document.getElementById('military-campaign-template');

    // Ajout dynamique des campagnes
    addMilitaryCampaignBtn.addEventListener('click', () => {
        const templateContent = militaryCampaignTemplate.content.cloneNode(true);
        const timestamp = Date.now();

        // Modifier les IDs et attributs "for" pour chaque élément dynamique
        templateContent.querySelectorAll('[id]').forEach(input => {
            const newId = `${input.id}_${timestamp}`;
            const label = templateContent.querySelector(`label[for="${input.id}"]`);
            if (label) {
                label.setAttribute('for', newId);
            }
            input.id = newId;
        });

        militaryCampaignsContainer.appendChild(templateContent);
        cleanTextareaInput(`campaign_locations_${timestamp}`);
    });

    // Suppression dynamique des campagnes
    militaryCampaignsContainer.addEventListener('click', (event) => {
        if (event.target.classList.contains('remove-military-campaign-btn')) {
            const militaryCampaign = event.target.closest('.military-campaign');
            if (militaryCampaign) {
                militaryCampaign.remove();
            }
        }
    });
});
</script>
