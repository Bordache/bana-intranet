<!-- Conteneur des historiques de grade -->
<section id="rank-histories-container">
    @if (old('history_rank'))
        @foreach (old('history_rank') as $index => $historyRank)
            <div class="rank-history pb-4 row g-3">

                <!-- Grade -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="history_rank_{{ $index }}" :value="__('Grade')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Rang militaire" role="img" aria-label="Rang militaire"></i>
                    <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                </div>
                <div class="col-md-7">
                    <x-select-input id="history_rank_{{ $index }}" name="history_rank[]"
                                    class="{{ $errors->has('history_rank.' . $index) ? 'is-invalid' : '' }}">
                        <option value="" {{ old('history_rank.' . $index) == null ? 'selected' : '' }}>
                            Choisir à la sélection
                        </option>
                        @foreach($ranks as $rank)
                            <option value="{{ $rank->rank_abbreviate }}"
                                    {{ old('history_rank.' . $index) == $rank->rank_abbreviate ? 'selected' : '' }}
                                    title="{{ $rank->rank_abbreviate }}">{{ $rank->rank_name }}</option>
                        @endforeach
                    </x-select-input>
                    <x-input-error class="mt-2" :messages="$errors->get('history_rank.' . $index)" />
                </div>

                <!-- Date d'effet -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="history_promotion_date_{{ $index }}" :value="__('Date d\'effet')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Pour compter de" role="img" aria-label="Pour compter de"></i>
                    <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="history_promotion_date_{{ $index }}" name="history_promotion_date[]" type="date"
                                  value="{{ old('history_promotion_date.' . $index) }}"
                                  class="{{ $errors->has('history_promotion_date.' . $index) ? 'is-invalid' : '' }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('history_promotion_date.' . $index)" />
                </div>

                <!-- Référence -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="history_rank_reference_{{ $index }}" :value="__('Référence')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Décision ou décret" role="img" aria-label="Décision ou décret"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="history_rank_reference_{{ $index }}" name="history_rank_reference[]" type="text"
                                  placeholder="Entrer décision ou décret"
                                  value="{{ old('history_rank_reference.' . $index) }}"
                                  class="{{ $errors->has('history_rank_reference.' . $index) ? 'is-invalid' : '' }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('history_rank_reference.' . $index)" />
                </div>

                <div class="col-md-12 text-end mt-3">
                    <button type="button" class="btn btn-danger remove-rank-btn">Supprimer ce grade</button>
                </div>
                <hr class="mt-4">
            </div>
        @endforeach
    @endif
</section>

<!-- Bouton "Ajouter grade" -->
<div class="mb-3 text-end">
    <button id="add-rank-btn" type="button" class="btn btn-primary">Ajouter grade</button>
</div>

<!-- Template pour les historiques de grade -->
<template id="rank-template">
    <div class="rank-history pb-4 row g-3">
        <!-- Grade -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="history_rank" :value="__('Grade')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Rang militaire" role="img" aria-label="Rang militaire"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-select-input id="history_rank" name="history_rank[]">
                <option value="">Choisir à la sélection</option>
                @foreach($ranks as $rank)
                    <option value="{{ $rank->rank_abbreviate }}" title="{{ $rank->rank_abbreviate }}">{{ $rank->rank_name }}</option>
                @endforeach
            </x-select-input>
        </div>

        <!-- Date d'effet -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="history_promotion_date" :value="__('Date d\'effet')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Pour compter de" role="img" aria-label="Pour compter de"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="history_promotion_date" name="history_promotion_date[]" type="date" />
        </div>

        <!-- Référence -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="history_rank_reference" :value="__('Référence')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Décision ou décret" role="img" aria-label="Décision ou décret"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="history_rank_reference" name="history_rank_reference[]" type="text"
                          placeholder="Entrer décision ou décret" />
        </div>

        <div class="col-md-12 text-end mt-3">
            <button type="button" class="btn btn-danger remove-rank-btn">Supprimer ce grade</button>
        </div>
        <hr class="mt-4">
    </div>
</template>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const addRankBtn = document.getElementById('add-rank-btn');
    const rankHistoriesContainer = document.getElementById('rank-histories-container');
    const rankTemplate = document.getElementById('rank-template');

    // Ajout dynamique des grades
    addRankBtn.addEventListener('click', () => {
        const templateContent = rankTemplate.content.cloneNode(true);
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

        rankHistoriesContainer.appendChild(templateContent);
    });

    // Suppression dynamique des grades
    rankHistoriesContainer.addEventListener('click', (event) => {
        if (event.target.classList.contains('remove-rank-btn')) {
            const rankHistory = event.target.closest('.rank-history');
            if (rankHistory) {
                rankHistory.remove();
            }
        }
    });
});
</script>
