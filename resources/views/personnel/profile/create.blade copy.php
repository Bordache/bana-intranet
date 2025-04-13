<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Gestion du personnel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="d-flex">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('personnel.index') }}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Nouveau profil</li>
                </ol>
                <div class="text-end">
                    <span class="btn btn-secondary mb-3" id="expandAllBtn">Tout déplier</span>
                </div>
              </nav>
            <!-- Étape 1 : Etat civil -->
            <form id="personnelForm" method="post" action="{{ route('personnel.store') }}" novalidate>
                @csrf
                <div class="p-4 sm:p-8 bg-white">
                    <div class="mx-auto">
                        <section>
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
                                    <button class="accordion-button {{ $errors->has('spouse_name')||$errors->has('name') ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                    Renseignements du (de la) conjoint(e)
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse {{ $errors->has('spouse_name') ? 'show' : '' }}" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
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

{{-- <script>
  /*  const ProfileValidationRules = {
       name: { required: true, type: 'string', maxLength: 255 },
       firstname: { required: false, type: 'string', maxLength: 255 },
       gender: { required: false, type: 'string', maxLength: 255 },
       birth_date: { required: false, type: 'date' },
       birth_place: { required: false, type: 'string', maxLength: 255 },
       national_id: { required: true, type: 'number', length: 12, unique: true },
       issue_date: { required: false, type: 'date' },
       issue_place: { required: false, type: 'string', maxLength: 255 },
       duplicate_date: { required: false, type: 'date' },
       duplicate_place: { required: false, type: 'string', maxLength: 255 },
       address: { required: false, type: 'string', maxLength: 255 },
       phone: { required: false, type: 'string', maxLength: 255 },
       email: { required: false, type: 'email', maxLength: 255 },
       blood_group: { required: false, type: 'string', maxLength: 255 },
       size: { required: false, type: 'integer', min: 0 },
       father_name: { required: false, type: 'string', maxLength: 255 },
       mother_name: { required: false, type: 'string', maxLength: 255 },
       marital_status: { required: false, type: 'string', maxLength: 255 },
       fallback_address: { required: false, type: 'string', maxLength: 255 },
       driver_license: { required: false, type: 'string', maxLength: 255 },
       practiced_sport: { required: false, type: 'string' },
       hobbies: { required: false, type: 'string' },
       army: { required: true, type: 'string', maxLength: 255 },
       position: { required: true, type: 'string', maxLength: 255 },
       position_date: { required: false, type: 'date' },
       position_reference: { required: false, type: 'string', maxLength: 255 },
       military_registration_number: { required: true, type: 'string', length: 6 },
       military_id_card_number: { required: false, type: 'string', length: 6 },
       finance_registration_number: { required: false, type: 'string', maxLength: 255 },
       recruitment_origin: { required: false, type: 'string', maxLength: 255 },
       recruitment_promotion: { required: false, type: 'string', maxLength: 255 },
       service_entry_date: { required: true, type: 'date' },
       corps_assignment: { required: true, type: 'string', maxLength: 255 },
       unit_assignment: { required: true, type: 'string', maxLength: 255 },
       rank: { required: true, type: 'string', maxLength: 255 },
       rank_date: { required: false, type: 'date' },
       current_function: { required: false, type: 'string', maxLength: 255 },
       specialty: { required: false, type: 'string', maxLength: 255 },
       exact_assignment: { required: false, type: 'string', maxLength: 255 },
       interruption_start_date: { required: false, type: 'date' },
       interruption_end_date: { required: false, type: 'date' },
       military_status: { required: false, type: 'string', maxLength: 255 },
       military_status_reference: { required: false, type: 'string', maxLength: 255 },
       military_driver_license: { required: false, type: 'string', maxLength: 255 },
       other_information: { required: false, type: 'string' },
   }; */

  /*  const existingNationalIds = ["123456789012", "987654321098"]; */
   /*  const existingEmails = ["example@test.com", "user@domain.com"];

    document.getElementById('personnelForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Empêche la soumission par défaut
        let isValid = true;
        const errors = {};

        // Fonction de validation pour chaque champ
        const validateField = (fieldName, value) => {
            const rules = ProfileValidationRules[fieldName];
            const fieldErrors = [];

            if (!rules) {
                return fieldErrors; // Aucun règle trouvée, ignorer le champ
            }

            if (rules.required && (!value || value.trim() === '')) {
                fieldErrors.push(`${fieldName} est obligatoire.`);
            }

            if (rules.type === 'string' && typeof value !== 'string') {
                fieldErrors.push(`${fieldName} doit être une chaîne de caractères.`);
            }

            if (rules.type === 'number' && isNaN(Number(value))) {
                fieldErrors.push(`${fieldName} doit être un nombre valide.`);
            }

            if (rules.maxLength && value.length > rules.maxLength) {
                fieldErrors.push(`${fieldName} ne peut pas dépasser ${rules.maxLength} caractères.`);
            }

            if (rules.length && value.length !== rules.length) {
                fieldErrors.push(`${fieldName} doit contenir exactement ${rules.length} caractères.`);
            }

            if (rules.unique) {
                if (
                    (fieldName === 'national_id' && existingNationalIds.includes(value)) ||
                    (fieldName === 'email' && existingEmails.includes(value))
                ) {
                    fieldErrors.push(`${fieldName} doit être unique.`);
                }
            }

            if (rules.type === 'email' && value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    fieldErrors.push(`${fieldName} doit être une adresse email valide.`);
                }
            }

            if (rules.type === 'date' && value) {
                if (isNaN(Date.parse(value))) {
                    fieldErrors.push(`${fieldName} doit être une date valide.`);
                }
            }

            return fieldErrors;
        };

        // Validation de chaque champ du formulaire
        Object.keys(ProfileValidationRules).forEach(fieldName => {
            const field = document.getElementsByName(fieldName)[0];
            if (field) {
                const fieldErrors = validateField(fieldName, field.value.trim());
                if (fieldErrors.length > 0) {
                    errors[fieldName] = fieldErrors;
                    isValid = false;

                    // Ajouter une classe d'erreur
                    field.classList.add('is-invalid');
                } else {
                    // Supprimer la classe d'erreur si valide
                    field.classList.remove('is-invalid');
                }
            }
        });

        // Gestion des erreurs dans les composants <x-input-error>
        Object.keys(ProfileValidationRules).forEach(fieldName => {
            const errorElement = document.getElementById(`${fieldName}Error`);
            if (errorElement) {
                const messages = errors[fieldName] || [];
                errorElement.setAttribute(':messages', JSON.stringify(messages)); // Utilisation simulée pour Vue.js
                errorElement.innerHTML = messages.join('<br>'); // Affiche les erreurs en HTML
            }
        });

        // Soumission si valide
        if (isValid) {
            alert('Formulaire soumis avec succès !');
            // form.submit();
        }
    }); */
</script> --}}

{{-- <script>

   // Define the fillable fields as objects
    const ProfileFillable = {
        name: { required: true, type: 'string', maxLength: 255 },
        firstname: { required: false, type: 'string', maxLength: 255 },
        gender: { required: false, type: 'string', maxLength: 255 },
        birth_date: { required: false, type: 'date' },
        birth_place: { required: false, type: 'string', maxLength: 255 },
        national_id: { required: true, type: 'number', maxLength: 12, unique: true },
        issue_date: { required: false, type: 'date' },
        issue_place: { required: false, type: 'string', maxLength: 255 },
        duplicate_date: { required: false, type: 'date' },
        duplicate_place: { required: false, type: 'string', maxLength: 255 },
        address: { required: false, type: 'string', maxLength: 255 },
        phone: { required: false, type: 'string', maxLength: 255 },
        email: { required: false, type: 'email', maxLength: 255 },
        blood_group: { required: false, type: 'string', maxLength: 255 },
        size: { required: false, type: 'integer', min: 150 },
        father_name: { required: false, type: 'string', maxLength: 255 },
        mother_name: { required: false, type: 'string', maxLength: 255 },
        marital_status: { required: false, type: 'string', maxLength: 255 },
        fallback_address: { required: false, type: 'string', maxLength: 255 },
        driver_license: { required: false, type: 'string', maxLength: 255 },
        practiced_sport: { required: false, type: 'string' },
        hobbies: { required: false, type: 'string' },
    };

    const MilitaryFillable = {
        army: { required: true, type: 'string', maxLength: 255 },
        position: { required: true, type: 'string', maxLength: 255 },
        position_date: { required: false, type: 'date' },
        position_reference: { required: false, type: 'string', maxLength: 255 },
        military_registration_number: { required: true, type: 'string', maxLength: 6 },
        military_id_card_number: { required: false, type: 'string', maxLength: 6 },
        finance_registration_number: { required: false, type: 'string', maxLength: 255 },
        recruitment_origin: { required: false, type: 'string', maxLength: 255 },
        recruitment_promotion: { required: false, type: 'string', maxLength: 255 },
        service_entry_date: { required: true, type: 'date' },
        corps_assignment: { required: true, type: 'string', maxLength: 255 },
        unit_assignment: { required: true, type: 'string', maxLength: 255 },
        rank: { required: true, type: 'string', maxLength: 255 },
        rank_date: { required: false, type: 'date' },
        current_function: { required: false, type: 'string', maxLength: 255 },
        specialty: { required: false, type: 'string', maxLength: 255 },
        exact_assignment: { required: false, type: 'string', maxLength: 255 },
        interruption_start_date: { required: false, type: 'date' },
        interruption_end_date: { required: false, type: 'date' },
        military_status: { required: false, type: 'string', maxLength: 255 },
        military_status_reference: { required: false, type: 'string', maxLength: 255 },
        military_driver_license: { required: false, type: 'string', maxLength: 255 },
        other_information: { required: false, type: 'string' },
    };

        // Function to check if a container is displayed
        function isContainerDisplayed(containerId) {
            return document.getElementById(containerId).style.display === 'block';
        }

    // Define other fillable objects similarly for Spouse, Child, School, Academy, Career, Rank, Distinction, Campaign

    const existingNationalIds = ["123456789012", "987654321098"];
    const existingEmails = ["example@test.com", "user@domain.com"];

    document.getElementById('personnelForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Empêche la soumission par défaut
        let isValid = true;
        const errors = {};

       /*  // Define the fillable fields (same logic as before)
        let SpouseFillable = {};
        let ChildFillable = {};
        let SchoolFillable = {};
        let AcademyFillable = {};
        let CareerFillable = {};
        let RankFillable = {};
        let DistinctionFillable = {};
        let CampaignFillable = {}; */

        // Récupération des champs à valider
        const formFields = { ...ProfileFillable, ...MilitaryFillable };

        // Gestion des enfants si le conteneur est visible
        if (isContainerDisplayed('children-paths-container')) {
            const childRows = document.querySelectorAll('.children-path'); // Supposons que chaque enfant a la classe "child-row"
            childRows.forEach((row, index) => {
                const childFillable = {
                    [`child_full_name_${index}`]: { required: true, type: 'string', maxLength: 255 },
                    [`child_birth_date_${index}`]: { required: true, type: 'date' },
                    [`child_birth_place_${index}`]: { required: false, type: 'string', maxLength: 255 },
                    [`child_gender_${index}`]: { required: true, type: 'string', maxLength: 255 },
                    [`child_status_${index}`]: { required: false, type: 'string' },
                };

                // Ajout des règles des enfants au formulaire principal
                Object.assign(formFields, childFillable);
            });
        }

        /* // Check visibility and define fillables
        if (isContainerDisplayed('spouse-details-container')) {
            SpouseFillable = {
                spouse_name: { required: true, type: 'string', maxLength: 255 },
                spouse_maiden_name: { required: false, type: 'string', maxLength: 255 },
                spouse_firstname: { required: false, type: 'string', maxLength: 255 },
                spouse_birth_date: { required: false, type: 'date' },
                spouse_birth_place: { required: false, type: 'string', maxLength: 255 },
                spouse_profession: { required: false, type: 'string', maxLength: 255 },
                marriage_authorization: { required: false, type: 'string', maxLength: 255 },
            };
        }

        if (isContainerDisplayed('children-paths-container')) {
            if (Array.isArray(request.child_full_name)) {
                request.child_full_name.forEach((childFullName, index) => {
                    if (childFullName) {
                        childFillable[`child_full_name.${index}`] = 'required|string|max:255';
                        childFillable[`child_birth_date.${index}`] = 'required|string|max:255';
                        childFillable[`child_birth_place.${index}`] = 'nullable|string|max:255';
                        childFillable[`child_gender.${index}`] = 'required|string|max:255';
                        childFillable[`child_status.${index}`] = 'nullable|string';
                    }
                });
            }
        }

        // Add similar checks for other containers like School, Academy, Career, etc.

        // Merge all validation rules
        const formFields = {
            ...ProfileFillable,
            ...MilitaryFillable,
            ...SpouseFillable,
            ...ChildFillable,
            ...SchoolFillable,
            ...AcademyFillable,
            ...CareerFillable,
            ...RankFillable,
            ...DistinctionFillable,
            ...CampaignFillable
        }; */

         // Fonction de validation pour chaque champ
         const validateField = (fieldName, value) => {
            const rules = formFields[fieldName];
            const fieldErrors = [];

            if (!rules) {
                return fieldErrors; // Aucun règle trouvée, ignorer le champ
            }

            if (rules.required && (!value || value.trim() === '')) {
                fieldErrors.push(`${fieldName} est obligatoire.`);
            }

            if (rules.type === 'string' && typeof value !== 'string') {
                fieldErrors.push(`${fieldName} doit être une chaîne de caractères.`);
            }

            if (rules.type === 'number' && isNaN(Number(value))) {
                fieldErrors.push(`${fieldName} doit être un nombre valide.`);
            }

            if (rules.maxLength && value.length > rules.maxLength) {
                fieldErrors.push(`${fieldName} ne peut pas dépasser ${rules.maxLength} caractères.`);
            }

            if (rules.length && value.length !== rules.length) {
                fieldErrors.push(`${fieldName} doit contenir exactement ${rules.length} caractères.`);
            }

            if (rules.unique) {
                if (
                    (fieldName === 'national_id' && existingNationalIds.includes(value)) ||
                    (fieldName === 'email' && existingEmails.includes(value))
                ) {
                    fieldErrors.push(`${fieldName} doit être unique.`);
                }
            }

            if (rules.type === 'email' && value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    fieldErrors.push(`${fieldName} doit être une adresse email valide.`);
                }
            }

            if (rules.type === 'date' && value) {
                if (isNaN(Date.parse(value))) {
                    fieldErrors.push(`${fieldName} doit être une date valide.`);
                }
            }

            return fieldErrors;
        };

        // Validation de chaque champ du formulaire
        Object.keys(formFields).forEach(fieldName => {
            const field = document.getElementsByName(fieldName)[0];
            if (field) {
                const fieldErrors = validateField(fieldName, field.value.trim());
                if (fieldErrors.length > 0) {
                    errors[fieldName] = fieldErrors;
                    isValid = false;

                    // Ajouter une classe d'erreur et déplier l'accordéon concerné
                    field.classList.add('is-invalid');
                    field.classList.remove('is-valid');
                    errorElement.innerHTML = fieldErrors.join('<br>');

                    if (field.closest('.collapse')) {
                        field.closest('.collapse').classList.add('show');
                    }
                } else {
                    // Ajouter la classe Bootstrap "is-valid" et supprimer les erreurs
                    field.classList.remove('is-invalid');
                    field.classList.add('is-valid');
                    errorElement.innerHTML = '';
                }
            }
        });

        // Gestion des erreurs dans les composants x-input-error
    /*     Object.keys(ProfileValidationRules).forEach(fieldName => {
            const errorElement = document.getElementById(`${fieldName}Error`);
            if (errorElement) {
                const messages = errors[fieldName] || [];
                if (messages.length > 0) {
                    errorElement.innerHTML = `
                        <ul>
                            ${messages.map(message => `<li class="text-danger">${message}</li>`).join('')}
                        </ul>
                    `;
                } else {
                    errorElement.innerHTML = '';
                }
            }
        }); */

        // Soumission si valide
        if (isValid) {
            alert('Formulaire soumis avec succès !');
            // form.submit();
        }
    });

</script> --}}

{{-- <script>
    // Définir les champs remplissables pour Profile et Military
    const ProfileFillable = {
        name: { required: true, type: 'string', maxLength: 255 },
        firstname: { required: false, type: 'string', maxLength: 255 },
        gender: { required: false, type: 'string', maxLength: 255 },
        birth_date: { required: false, type: 'date' },
        birth_place: { required: false, type: 'string', maxLength: 255 },
        national_id: { required: true, type: 'number', maxLength: 12, unique: true },
        issue_date: { required: false, type: 'date' },
        issue_place: { required: false, type: 'string', maxLength: 255 },
        duplicate_date: { required: false, type: 'date' },
        duplicate_place: { required: false, type: 'string', maxLength: 255 },
        address: { required: false, type: 'string', maxLength: 255 },
        phone: { required: false, type: 'string', maxLength: 255 },
        email: { required: false, type: 'email', maxLength: 255 },
        blood_group: { required: false, type: 'string', maxLength: 255 },
        size: { required: false, type: 'integer', min: 150 },
        father_name: { required: false, type: 'string', maxLength: 255 },
        mother_name: { required: false, type: 'string', maxLength: 255 },
        marital_status: { required: false, type: 'string', maxLength: 255 },
        fallback_address: { required: false, type: 'string', maxLength: 255 },
        driver_license: { required: false, type: 'string', maxLength: 255 },
        practiced_sport: { required: false, type: 'string' },
        hobbies: { required: false, type: 'string' },
    };

    const MilitaryFillable = {
        army: { required: true, type: 'string', maxLength: 255 },
        position: { required: true, type: 'string', maxLength: 255 },
        position_date: { required: false, type: 'date' },
        position_reference: { required: false, type: 'string', maxLength: 255 },
        military_registration_number: { required: true, type: 'string', maxLength: 6 },
        military_id_card_number: { required: false, type: 'string', maxLength: 6 },
        finance_registration_number: { required: false, type: 'string', maxLength: 255 },
        recruitment_origin: { required: false, type: 'string', maxLength: 255 },
        recruitment_promotion: { required: false, type: 'string', maxLength: 255 },
        service_entry_date: { required: true, type: 'date' },
        corps_assignment: { required: true, type: 'string', maxLength: 255 },
        unit_assignment: { required: true, type: 'string', maxLength: 255 },
        rank: { required: true, type: 'string', maxLength: 255 },
        rank_date: { required: false, type: 'date' },
        current_function: { required: false, type: 'string', maxLength: 255 },
        specialty: { required: false, type: 'string', maxLength: 255 },
        exact_assignment: { required: false, type: 'string', maxLength: 255 },
        interruption_start_date: { required: false, type: 'date' },
        interruption_end_date: { required: false, type: 'date' },
        military_status: { required: false, type: 'string', maxLength: 255 },
        military_status_reference: { required: false, type: 'string', maxLength: 255 },
        military_driver_license: { required: false, type: 'string', maxLength: 255 },
        other_information: { required: false, type: 'string' },
    };

    const existingNationalIds = ["123456789012", "987654321098"];
    const existingEmails = ["example@test.com", "user@domain.com"];

        // Fonction de validation des enfants dynamiques
        function getChildFields() {
    const childContainers = document.querySelectorAll('.children-path'); // Tous les conteneurs enfants
    const childFields = {};

    childContainers.forEach((container, index) => {
        const childFillable = {
            [`child_full_name[${index}]`]: { required: true, type: 'string', maxLength: 255 },
            [`child_birth_date[${index}]`]: { required: true, type: 'date' },
            [`child_birth_place[${index}]`]: { required: false, type: 'string', maxLength: 255 },
            [`child_gender[${index}]`]: { required: true, type: 'string', maxLength: 255 },
            [`child_status[${index}]`]: { required: false, type: 'string' },
        };
        Object.assign(childFields, childFillable);
    });

    return childFields;
    }


    // Fonction de validation de champ
    function validateField(fieldName, value, rules) {
        const errors = [];
        if (rules.required && (!value || value.trim() === '')) {
            errors.push(`${fieldName} est obligatoire.`);
        }
        if (rules.type === 'string' && typeof value !== 'string') {
            errors.push(`${fieldName} doit être une chaîne de caractères.`);
        }
        if (rules.type === 'number' && isNaN(Number(value))) {
            errors.push(`${fieldName} doit être un nombre valide.`);
        }
        if (rules.maxLength && value.length > rules.maxLength) {
            errors.push(`${fieldName} ne peut pas dépasser ${rules.maxLength} caractères.`);
        }
        if (rules.unique) {
            if (
                (fieldName === 'national_id' && existingNationalIds.includes(value)) ||
                (fieldName === 'email' && existingEmails.includes(value))
            ) {
                errors.push(`${fieldName} doit être unique.`);
            }
        }
        if (rules.type === 'email' && value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                errors.push(`${fieldName} doit être une adresse email valide.`);
            }
        }
        if (rules.type === 'date' && value) {
            if (isNaN(Date.parse(value))) {
                errors.push(`${fieldName} doit être une date valide.`);
            }
        }
        return errors;
    }

    // Fonction de soumission du formulaire
    document.getElementById('personnelForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Empêche la soumission par défaut



        const formFields = { ...ProfileFillable, ...MilitaryFillable };
        const childFields = getChildFields();
        Object.assign(formFields, childFields); // Ajouter les champs enfants au formulaire principal
        alert(JSON.stringify(formFields, null, 2));
        const errors = {};
        let isValid = true;

        Object.keys(formFields).forEach(fieldName => {
            const field = document.querySelector(`[name="${fieldName}"]`);
            if (field) {
                const value = field.value.trim();
                const fieldErrors = validateField(fieldName, value, formFields[fieldName]);
                if (fieldErrors.length > 0) {
                    errors[fieldName] = fieldErrors;
                    isValid = false;

                    // Ajouter des classes d'erreur au champ
                    field.classList.add('is-invalid');
                    const errorElement = field.nextElementSibling;
                    if (errorElement) {
                        errorElement.innerHTML = fieldErrors.join('<br>');
                    }
                } else {
                    // Supprimer les classes d'erreur
                    field.classList.remove('is-invalid');
                    const errorElement = field.nextElementSibling;
                    if (errorElement) {
                        errorElement.innerHTML = '';
                    }
                }
            }
        });

        if (isValid) {
            alert('Formulaire soumis avec succès !');
            // Soumettez le formulaire ou procédez à l'étape suivante
        }
    });
</script> --}}

