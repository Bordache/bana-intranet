<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BANA') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
        <style>
            @media print {
                input[type="checkbox"] {
                    display: none;
                }
            }
        </style>


        <!-- Scripts -->
        <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>


        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white border-bottom">
                    <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Toast -->
    @if(session('success'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 10000">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="fas fa-check-circle text-success px-2"></i>
                    <strong class="me-auto">Bravo !</strong>
                    <small>A l'instant</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    @if (@session('danger'))
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 10000">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fas fa-exclamation-circle text-danger px-2"></i>
                <strong class="me-auto">Danger !</strong>
                <small>A l'instant</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('danger') }}
            </div>
        </div>
    </div>
    @endsession

    @if (@session('warning'))
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 10000">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fas fa-exclamation-circle text-warning px-2"></i>
                <strong class="me-auto">Attention !</strong>
                <small>A l'instant</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('warning') }}
            </div>
        </div>
    </div>
    @endsession

    @if (@session('info'))
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 10000">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fas fa-circle-info text-info px-2"></i>
                <strong class="me-auto">Informations !</strong>
                <small>A l'instant</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('info') }}
            </div>
        </div>
    </div>
    @endsession
    </body>
</html>

<!-- Script to trigger the toast -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toastElement = document.getElementById('liveToast');
        const toast = new bootstrap.Toast(toastElement);
        toast.show(); // Automatically display the toast
    });
</script>

<script>
    // Supprime les espaces ou sauts de ligne superflus
    document.addEventListener("DOMContentLoaded", () => {
        const textareaInputs = document.querySelectorAll('textarea');
        textareaInputs.forEach(textarea => {
                textarea.value = textarea.value.trim();
        });
    });

    function cleanTextareaInput(fieldId) {
        const textarea = document.getElementById(fieldId);
        if (textarea) {
            textarea.value = textarea.value.trim();
        }
    }
</script>

<!-- Plier et déplier un accordéon -->
<script>
    const expandAllBtn = document.getElementById('expandAllBtn');
    const drapeAllBtn = document.getElementById('drapeAllBtn');
    const collapses = document.querySelectorAll('.accordion-collapse');

    expandAllBtn.addEventListener('click', () => {
        collapses.forEach(collapse => {
            collapse.classList.add('show'); // Ajouter la classe `show`
            const button = collapse.previousElementSibling.querySelector('button');
            button.classList.remove('collapsed'); // Enlever la classe `collapsed` des boutons
            button.setAttribute('aria-expanded', 'true'); // Mettre `aria-expanded` à `true`
        });
        expandAllBtn.classList.add('d-none');
        drapeAllBtn.classList.remove('d-none');
    });

    drapeAllBtn.addEventListener('click', () => {
        collapses.forEach(collapse => {
            collapse.classList.remove('show'); // Enlever la classe `show`
            const button = collapse.previousElementSibling.querySelector('button');
            button.classList.add('collapsed'); // Ajouter la classe `collapsed` des boutons
            button.setAttribute('aria-expanded', 'false'); // Mettre `aria-expanded` à `false`
        });
        expandAllBtn.classList.remove('d-none');
        drapeAllBtn.classList.add('d-none');
    });
</script>

<!-- Export excel and pdf format -->
<script>
    document.getElementById('exportButton').addEventListener('click', function () {
        let selectedProfiles = [];
        document.querySelectorAll('.profile-checkbox:checked').forEach((checkbox) => {
            selectedProfiles.push(checkbox.value);
        });

        if (selectedProfiles.length === 0) {
            alert("Veuillez sélectionner au moins un profil à exporter.");
            return;
        }

        let selectedFields = [];
        document.querySelectorAll('.export-field:checked').forEach((checkbox) => {
            selectedFields.push(checkbox.value);
        });

        if (selectedFields.length === 0) {
            alert("Aucune colonne n'est cochée.");
            return;
        }

        // ✅ Affichage de l'alerte avec trois choix
        let exportType = prompt("Choisissez le format d'exportation :\n\n1 - Excel 📊\n2 - PDF 📄\n\nAnnuler pour abandonner.");

        if (exportType === null) {
            return; // L'utilisateur a annulé
        } else if (exportType === "1") {
            exportType = "excel";
        } else if (exportType === "2") {
            exportType = "pdf";
        } else {
            alert("Choix invalide !");
            return;
        }

        // ✅ Création et soumission du formulaire POST dynamique
        let form = document.createElement('form');
        form.method = 'POST';
        form.action = "{{ route('personnel.export') }}";

        let csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = "{{ csrf_token() }}";
        form.appendChild(csrfToken);

        let profilesInput = document.createElement('input');
        profilesInput.type = 'hidden';
        profilesInput.name = 'profile_ids';
        profilesInput.value = JSON.stringify(selectedProfiles);
        form.appendChild(profilesInput);

        let fieldsInput = document.createElement('input');
        fieldsInput.type = 'hidden';
        fieldsInput.name = 'fields';
        fieldsInput.value = JSON.stringify(selectedFields);
        form.appendChild(fieldsInput);

        let typeInput = document.createElement('input');
        typeInput.type = 'hidden';
        typeInput.name = 'export_type';
        typeInput.value = exportType;
        form.appendChild(typeInput);

        document.body.appendChild(form);
        form.submit();
    });
</script>

<!-- Coche et décoche des inputs checkbox -->
<script>
    function toggleCheckboxes(masterCheckbox) {
        // Récupère tous les checkboxes de la table
        const checkboxes = document.querySelectorAll('.checkItem');

        // Pour chaque checkbox, on met son état selon l'état du masterCheckbox
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = masterCheckbox.checked;
        });
    }
</script>


