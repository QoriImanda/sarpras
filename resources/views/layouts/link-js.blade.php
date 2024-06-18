{{-- select2 --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('assets/assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="{{ asset('assets/assets/vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset('assets/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/assets/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('assets/assets/js/main.js') }}"></script>


{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script> --}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

<!-- Skrip untuk React -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/react/17.0.2/umd/react.production.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/17.0.2/umd/react-dom.production.min.js"></script>

<!-- Skrip untuk Babel (Untuk mengubah kode JSX menjadi JavaScript biasa) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.26.0/babel.min.js"></script>

{{-- datatables responsive mobile --}}
<script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.5.0/js/dataTables.rowReorder.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.5.0/js/rowReorder.dataTables.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.0/js/responsive.dataTables.js"></script>

<script>
    $(document).ready(function() {

        $(".selectProdi").select2({
            theme: 'bootstrap-5'
        });

    });
</script>

@yield('script')
@yield('script1')
@yield('script2')
@yield('script3')
@yield('script4')
