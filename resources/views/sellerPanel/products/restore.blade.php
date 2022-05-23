@extends('sellerPanel.front')
@section('content')
    <div class="content">
        <div class="form-group row">
            <div class="col-4 mx-auto text-center">
                <img src="/cliparts/sync.png" class="img-fluid w-75" />
                <h2>Product "{{ $product->name }}" has been marked as deleted!</h2>
                <button type="button" class="btn btn-lg btn-primary btn-restore" data-id="{{ $id }}">Restore Product?</button>
            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')
    <script>
        (function($) {
            $(document).ready(function() {
                $( document ).on( 'click', '.btn-restore', function() {
                    const id = $( this ).data( 'id' )

                    Swal.fire({
                        icon: 'info',
                        title: 'Are you sure?',
                        text: 'Product will be restored and will be visible to the shop!',
                        showCancelButton: true,
                        showConfirmButton: true,
                        confirmButtonColor: '#dc3545',
                        confirmButtonText: 'Confirm'
                    }).then( (event) => {
                        if ( event.value ) {
                            fetch( `/api/seller/restore-product`, {
                                method: 'POST',
                                headers: {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify( { id: id } )
                            } ).then( r => r.json() ).then( res => {

                                if ( ! res.success ) {
                                    Swal.fire({
                                        icon: 'info',
                                        title: 'Restore failed',
                                        text: res.message
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Restore Success',
                                        text: res.message
                                    }).then(() => {
                                        window.location.href = `/sellerpanel/product_info/${id}`
                                    })
                                }

                            } )
                        }
                    })
                } )
            })
        })(jQuery)
    </script>
@endsection