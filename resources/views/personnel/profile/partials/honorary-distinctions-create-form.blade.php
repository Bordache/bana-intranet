<!-- Conteneur des distinctions honorifiques -->
<section id="honorary-distinctions-container">
    @if (old('honorary_title'))
        @foreach (old('honorary_title') as $index => $honoraryTitle)
            <div class="honorary-distinction pb-4 row g-3">

                <!-- Intitulé -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="honorary_title_{{ $index }}" :value="__('Intitulé')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Décoration" role="img" aria-label="Décoration"></i>
                    <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="honorary_title_{{ $index }}" name="honorary_title[]" type="text"
                                  placeholder="Entrer intitulé distinction"
                                  value="{{ $honoraryTitle }}"
                                  class="{{ $errors->has('honorary_title.' . $index) ? 'is-invalid' : '' }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('honorary_title.' . $index)" />
                </div>

                <!-- Promotion -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="honorary_promotion_{{ $index }}" :value="__('Promotion')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Promotion" role="img" aria-label="Promotion"></i>
                    <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="honorary_promotion_{{ $index }}" name="honorary_promotion[]" type="text"
                                  placeholder="Entrer promotion"
                                  value="{{ old('honorary_promotion.' . $index) }}"
                                  class="{{ $errors->has('honorary_promotion.' . $index) ? 'is-invalid' : '' }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('honorary_promotion.' . $index)" />
                </div>

                <!-- Référence -->
                <div class="col-md-4 d-flex pt-2">
                    <x-input-label for="honorary_reference_{{ $index }}" :value="__('Référence')" />
                </div>
                <div class="col-md-1 d-flex pt-2">
                    <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Référence" role="img" aria-label="Référence"></i>
                </div>
                <div class="col-md-7">
                    <x-text-input id="honorary_reference_{{ $index }}" name="honorary_reference[]" type="text"
                                  placeholder="Entrer référence"
                                  value="{{ old('honorary_reference.' . $index) }}"
                                  class="{{ $errors->has('honorary_reference.' . $index) ? 'is-invalid' : '' }}" />
                    <x-input-error class="mt-2" :messages="$errors->get('honorary_reference.' . $index)" />
                </div>

                <div class="col-md-12 text-end mt-3">
                    <button type="button" class="btn btn-danger remove-honorary-btn">Supprimer cette distinction</button>
                </div>
                <hr class="mt-4">
            </div>
        @endforeach
    @endif
</section>

<!-- Bouton "Ajouter distinction honorifique" -->
<div class="mb-3 text-end">
    <button id="add-honorary-btn" type="button" class="btn btn-primary">Ajouter distinction honorifique</button>
</div>

<!-- Template pour les distinctions honorifiques -->
<template id="honorary-template">
    <div class="honorary-distinction pb-4 row g-3">
        <!-- Intitulé -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="honorary_title" :value="__('Intitulé')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Décoration" role="img" aria-label="Décoration"></i>
            <i class="icon fa fa-circle-exclamation text-danger fa-fw p-1" title="Requis" role="img" aria-label="Requis"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="honorary_title" name="honorary_title[]" type="text" placeholder="Entrer intitulé distinction" />
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
            <x-text-input id="honorary_promotion" name="honorary_promotion[]" type="text" placeholder="Entrer promotion" />
        </div>

        <!-- Référence -->
        <div class="col-md-4 d-flex pt-2">
            <x-input-label for="honorary_reference" :value="__('Référence')" />
        </div>
        <div class="col-md-1 d-flex pt-2">
            <i class="icon fa fa-info-circle text-secondary fa-fw p-1" title="Référence" role="img" aria-label="Référence"></i>
        </div>
        <div class="col-md-7">
            <x-text-input id="honorary_reference" name="honorary_reference[]" type="text" placeholder="Entrer référence" />
        </div>

        <div class="col-md-12 text-end mt-3">
            <button type="button" class="btn btn-danger remove-honorary-btn">Supprimer cette distinction</button>
        </div>
        <hr class="mt-4">
    </div>
</template>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const addHonoraryBtn = document.getElementById('add-honorary-btn');
    const honoraryContainer = document.getElementById('honorary-distinctions-container');
    const honoraryTemplate = document.getElementById('honorary-template');

    // Ajout dynamique des distinctions
    addHonoraryBtn.addEventListener('click', () => {
        const templateContent = honoraryTemplate.content.cloneNode(true);
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

        honoraryContainer.appendChild(templateContent);
    });

    // Suppression dynamique des distinctions
    honoraryContainer.addEventListener('click', (event) => {
        if (event.target.classList.contains('remove-honorary-btn')) {
            const honoraryDistinction = event.target.closest('.honorary-distinction');
            if (honoraryDistinction) {
                honoraryDistinction.remove();
            }
        }
    });
});
</script>
