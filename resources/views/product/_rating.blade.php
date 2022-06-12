<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
.checked {
    color: orange;
}
</style>
@if ( ! $rating )
    <span>Unrated</span>

@else
    <span>Your rating: </span>
@endif

<a class="product--rate-container">
    @foreach ( range( 1, 5 ) as $rate )
        <span class="fa fa-star product--rate {{ ( $rating >= $rate ) ? 'checked' : '' }}" data-rate="{{ $rate }}" data-data="{{ $order_id . ':' . $product_id . ':' . $user_id }}"></span>
    @endforeach
</a>

<script>
    window.addEventListener( 'DOMContentLoaded', () => {
        const rates = document.getElementsByClassName( 'product--rate' )

        Array.from( rates ).forEach( function( el ) {
            el.addEventListener( 'click', triggerRate )
        })

        function triggerRate() {
            const self = this
            const rate = this.getAttribute( 'data-rate' )
            const data = this.getAttribute( 'data-data' )

            fetch( `/api/products/rate`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify( {
                    rate: rate,
                    data: data
                } )
            } ).then( r => r.json() ).then( res => {
                if ( res?.success ) {
                    const parent = $( self ).parents( '.product--rate-container' )
                    const parentRates = parent.find( '.product--rate' )

                    parentRates.each( function() {
                        $( this ).removeClass( 'checked' )
                        if ( rate >= $( this ).data( 'rate' ) ) {
                            $( this ).addClass( 'checked' )
                        }
                    } )
                }
            } )
        }
    } )
</script>