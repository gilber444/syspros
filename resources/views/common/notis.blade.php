<script>
    document.addEventListener('DOMContentLoaded', function(){
        window.livewire.on('show-modal', msg =>{
            $('#myModal').modal('show');
        });
        window.livewire.on('item-added', msg =>{
            $('#myModal').modal('hide');
            Swal.fire({
                icon: 'success',
                title: 'Agregado!',
                text: msg,
                customClass: {
                    confirmButton: 'btn btn-success'
                }
            });
        });
        window.livewire.on('item-updated', msg =>{
            $('#myModal').modal('hide');
            Swal.fire({
                icon: 'success',
                title: 'Actualizado!',
                text: msg,
                customClass: {
                    confirmButton: 'btn btn-success'
                }
            });
        });
    });

    function Confirm(id, productos)
    {
        if(productos > 0)
        {
            Swal.fire({
                title: 'Error',
                text: 'No se puede eliminar el registro porque tiene productos relacionados',
                icon: 'error'
            })
            return;
        }

        Swal.fire({
        title: 'Confirmar',
        text: 'Estas seguro de eliminar este registro!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, Eliminar',
        customClass: {
          confirmButton: 'btn btn-primary me-3',
          cancelButton: 'btn btn-label-secondary'
        },
        buttonsStyling: false
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow', id)
                window.livewire.on('item-deleted', msg =>{
                    Swal.fire({
                        icon: 'success',
                        title: 'Actualizado!',
                        text: msg,
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    });
                });
            }
        })
    }
</script>
