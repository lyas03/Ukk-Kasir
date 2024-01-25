// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    "paging": true, // Aktifkan pembagian halaman
    "lengthChange": false, // Nonaktifkan kemampuan mengubah jumlah baris per halaman
    "searching": true, // Aktifkan pencarian
    "ordering": true, // Aktifkan pengurutan
    "info": true, // Tampilkan informasi tentang tabel
    "autoWidth": false // Nonaktifkan perhitungan lebar otomatis
});
});
