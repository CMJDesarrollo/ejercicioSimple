$(document).ready(function() {
    $('#prods').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        }
    });

    $('.btnEdit').click(function(){
        const id = $(this).data('id');
        
        $(location).attr('href', '?mod=ProdEdit&id=' + id);
    });
});
