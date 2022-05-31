<script>
    $(document).ready(function() {
        $( '#datatable' ).DataTable()

        $( document ).on( 'click', '.btn--delete-confirm', function() {
            const text = $( this ).data( 'text' )
            const href = $( this ).data( 'href' )
            const action = $( this ).data( 'action' )

            Swal.fire({
                icon: 'warning',
                title: 'Are you sure?',
                text: text,
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Confirm'
            }).then((event) => {
                if ( event.value ) {
                    if ( action ) {
                        fetch( href, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            }
                        } ).then( r => r.json() ).then( res => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Delete Success',
                                text: res.message
                            }).then(() => {
                                window.location.reload()
                            })
                        } )
                    } else {
                        window.location.href = href
                    }
                }

            })
        } )
    });
</script>