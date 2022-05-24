<script>
    $(document).ready(function() {
        $( document ).on( 'click', '.btn--delete-confirm', function() {
            const text = $( this ).data( 'text' )
            const href = $( this ).data( 'href' )

            Swal.fire({
                icon: 'warning',
                title: 'Are you sure?',
                text: text,
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Confirm'
            }).then((event) => {
                if ( event.value ) window.location.href = href
            })
        } )
    });
</script>