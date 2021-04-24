$(document).ready(function()
	{
        $('#deleteDevolucion').on('show.bs.modal', function (event) {   
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.            
            

            action = $('#formDelete').attr('data-action').slice(0,-1)
            action += id
            

            $('#formDelete').attr('action',action)

            var modal = $(this)
            modal.find('.modal-title').text('Vas a borrar la devolucion: ' + id)
          })
});
    