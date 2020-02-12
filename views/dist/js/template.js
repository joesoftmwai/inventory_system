// side bar menu
$('.sidebar-menu').tree();

// activate the DATA TABLE PLUGIN

$('._tables').DataTable();


// iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue'
});


/**
 * :: Input mask
 */

//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'});
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'});
//Money Euro
$('[data-mask]').inputmask();