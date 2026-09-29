<x-layouts.app.sidebar :title="$title ?? null">
    <style>
    /* Cambiar color del texto del dropdown */
    .select2-container--classic .select2-results__option {
        color: black !important;
    }

    .select2-container--classic .select2-results__option:hover {
        color: white !important;
        background: #0047DC !important;
    }

    /* Cambiar color del placeholder */
    .select2-container--classic .select2-selection__placeholder {
        color: black !important; /* Tailwind gray-500 */
    }

    /* Cambiar color del texto en el área de búsqueda dentro del dropdown */
    .select2-search__field {
        color: black !important;
    }
</style>
    <flux:main class="bg-zinc-800">
        {{ $slot }}
        <!-- sistema de alerta -->
        @vite(['resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Operación exitosa!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 5000,
                    toast: true,
                    position: 'center-center',
                    showClass: {
                        popup: `
                        animate__animated
                        animate__fadeInUp
                        animate__faster
                        `
                    },
                    hideClass: {
                        popup: `
                        animate__animated
                        animate__fadeOutDown
                        animate__faster
                        `
                    }
                });
            </script>
        @endif
    </flux:main>
    <script>
        $(document).ready(function () {
            $('.select2-field').select2({
                placeholder: "Seleccionar un post...",
                allowClear: true,
                width: '100%',
                theme: 'classic'
            });
        });
    </script>
</x-layouts.app.sidebar>
