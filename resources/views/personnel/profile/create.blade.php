<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Gestion du personnel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('personnel.index') }}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Nouveau profil</li>
                </ol>
              </nav>
            <!-- Étape 1 : Etat civil -->
            <form method="post" action="{{ route('personnel.store') }}">
            @csrf
            <div class="p-4 sm:p-8 bg-white">
                <div class="mx-auto">
                    <section>
                        <div class="text-end">
                            <span class="btn btn-secondary mb-3" id="expandAllBtn">Tout déplier</span>
                        </div>

                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <!-- Accordion Item #1 -->
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                  Informations générales
                                </button>
                              </h2>
                              <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    @include('personnel.profile.partials.personnal-informations-create-form')
                                </div>
                              </div>
                            </div>

                            <!-- Accordion Item #2 -->
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="true" aria-controls="flush-collapseTwo">
                                  Renseignements militaires
                                </button>
                              </h2>
                              <div id="flush-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    @include('personnel.profile.partials.military-details-create-form')
                                </div>
                              </div>
                            </div>

                            <!-- Accordion Item #3 -->
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                  Renseignements du (de la) conjoint(e)
                                </button>
                              </h2>
                              <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    @include('personnel.profile.partials.spouse-details-create-form')
                                </div>
                              </div>
                            </div>

                            <!-- Accordion Item #4 -->
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                  Renseignements des enfants
                                </button>
                              </h2>
                              <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    @include('personnel.profile.partials.children-details-create-form')
                                </div>
                              </div>
                            </div>

                            <!-- Accordion Item #5 -->
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                  Parcours scolaires
                                </button>
                              </h2>
                              <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    @include('personnel.profile.partials.academic-paths-create-form')
                                </div>
                              </div>
                            </div>

                            <!-- Accordion Item #6 -->
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                    Parcours militaires
                                </button>
                              </h2>
                              <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    @include('personnel.profile.partials.military-paths-create-form')
                                </div>
                              </div>
                            </div>

                            <!-- Accordion Item #7 -->
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-headingSeven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                                    Parcours professionnels
                                </button>
                              </h2>
                              <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    @include('personnel.profile.partials.professional-careers-create-form')
                                </div>
                              </div>
                            </div>

                            <!-- Accordion Item #8 -->
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-headingEight">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight" aria-expanded="false" aria-controls="flush-collapseEight">
                                  Grades successifs
                                </button>
                              </h2>
                              <div id="flush-collapseEight" class="accordion-collapse collapse" aria-labelledby="flush-headingEight" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                  @include('personnel.profile.partials.rank-histories-create-form')
                                </div>
                              </div>
                            </div>

                             <!-- Accordion Item #9 -->
                             <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingNine">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseNine" aria-expanded="false" aria-controls="flush-collapseNine">
                                    Décorations successives
                                  </button>
                                </h2>
                                <div id="flush-collapseNine" class="accordion-collapse collapse" aria-labelledby="flush-headingNine" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body">
                                    @include('personnel.profile.partials.honorary-distinctions-create-form')
                                  </div>
                                </div>
                              </div>

                              <!-- Accordion Item #10 -->
                             <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTen">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTen" aria-expanded="false" aria-controls="flush-collapseTen">
                                    Campagnes militaires
                                  </button>
                                </h2>
                                <div id="flush-collapseTen" class="accordion-collapse collapse" aria-labelledby="flush-headingTen" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body">
                                    @include('personnel.profile.partials.military-campaigns-create-form')
                                  </div>
                                </div>
                              </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="text-center p-4">
                <x-primary-button>{{ __('Créer le profil') }}</x-primary-button>
            </div>

        </form>
        </div>
    </div>
</x-app-layout>
<script>
    document.getElementById('expandAllBtn').addEventListener('click', () => {
      // Obtenir tous les éléments d'accordéon
      const collapses = document.querySelectorAll('.accordion-collapse');
      collapses.forEach(collapse => {
        collapse.classList.add('show'); // Ajouter la classe `show`
        const button = collapse.previousElementSibling.querySelector('button');
        button.classList.remove('collapsed'); // Enlever la classe `collapsed` des boutons
        button.setAttribute('aria-expanded', 'true'); // Mettre `aria-expanded` à `true`
      });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Liste des IDs à traiter
        const fields = ["birth_place", "address", "fallback_address", "other_information", "diploma", "diploma.*", "academy_diploma", "academy_diploma.*"];

        fields.forEach(fieldId => {
            const textarea = document.getElementById(fieldId);
            if (textarea) {
                // Supprime les espaces ou sauts de ligne superflus
                textarea.value = textarea.value.trim();
            }
        });
    });
</script>

<script>
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>
