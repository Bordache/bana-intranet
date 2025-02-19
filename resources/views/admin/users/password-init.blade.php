<x-app-layout>
    <x-slot name="header">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb"
            class="d-flex justify-content-between align-items-center text-sm">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Administration</a></li>
                <li class="breadcrumb-item active" aria-current="page">Paramètres globaux</li>
            </ol>
        </nav>
        <h2 class="pt-3 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mots de passe initiaux') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6 pb-5">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-success" onclick="exportTableToPDF()"><i class="fas fa-file-export"></i> Exporter en pdf</button>
            </div>
            <div class="card-body">
                @include('components.password-init')
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function exportTableToPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        doc.text("Liste des utilisateurs", 14, 10);

        const table = document.getElementById('dataTable');
        const headers = [];
        const data = [];

        // Récupérer les en-têtes (sans la colonne des checkboxes)
        const headerCells = table.querySelectorAll('thead th');
        for (let i = 1; i < headerCells.length; i++) {
            headers.push(headerCells[i].innerText);
        }

        // Récupérer les lignes sélectionnées
        const rows = table.querySelectorAll('tbody tr');
        rows.forEach(row => {
            const checkbox = row.querySelector('.profile-checkbox');
            if (checkbox.checked) {
                const rowData = [];
                const cells = row.querySelectorAll('td');
                for (let i = 1; i < cells.length; i++) {
                    rowData.push(cells[i].innerText);
                }
                data.push(rowData);
            }
        });

        if (data.length === 0) {
            alert("Veuillez sélectionner au moins une ligne !");
            return;
        }

        // Générer le tableau PDF avec les lignes sélectionnées
        doc.autoTable({
            head: [headers],
            body: data,
            startY: 20,
            theme: 'grid'
        });

        doc.save("tableau.pdf");
    }
</script>


