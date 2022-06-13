@extends('layouts.app_enlink')

@section('content')
<div class="modal " id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title lead">Registration procedure</h5>
      
      </div>
      <div class="modal-body">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img class="d-block w-100" src="/registration_modal_pics/regist1.png" alt="First slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="/registration_modal_pics/regist2.png" alt="Second slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="/registration_modal_pics/regist3.png" alt="Third slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="/registration_modal_pics/regist4.png" alt="Third slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="/registration_modal_pics/regist5.png" alt="Third slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="/registration_modal_pics/regist6.png" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <img src="next_modal_regs/previous.png" height="40">
                <span class="sr-only" >Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <img src="next_modal_regs/next.png" height="40">
                <span class="sr-only" >Next</span>
            </a>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script>
    <div class="container" >
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form  class="row g-3 needs-validation" id="auth--register" novalidate method="POST" action="{{ route('register') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div id="first_page">
                        @include('auth.register_section')
                    </div>
                </form>
                <script>
                // Example starter JavaScript for disabling form submissions if there are invalid fields
                    (function () {
                        'use strict'

                        let isValid = false
                        // Fetch all the forms we want to apply custom Bootstrap validation styles to
                        var forms = document.querySelectorAll('.needs-validation')

                        // Loop over them and prevent submission
                        Array.prototype.slice.call(forms)
                            .forEach(function (form) {
                            form.addEventListener('submit', function (event) {
                                if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                                }

                                form.classList.add('was-validated')
                            }, false)
                        })

                        $( document ).on( 'submit', '#auth--register', function( e ) {
                            const data = $( this ).serialize()

                            $( '#auth--register .invalid-feedback.d-block' ).each( function() {
                                $( this ).removeClass( 'd-block' )
                            } )

                            if ( ! isValid ) {
                                e.preventDefault()

                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                })

                                $.ajax({
                                    type: 'POST',
                                    url: '/validate/register',
                                    data: data,
                                    success: function( res ) {
                                        if ( res.success ) {
                                            isValid = true
                                            $( '#auth--register' ).trigger( 'submit' )

                                        } else {
                                            const errors = res?.errors

                                            Object.keys( errors ).forEach( el => {
                                                const id = el
                                                const text = errors[el][0]
                                                const err = $( `#${id}` ).next( '.invalid-feedback' )

                                                err.addClass( 'd-block' )
                                                err.text( text )
                                            } )

                                        }
                                    },
                                    
                                })
                            }
                        } )
                    })()
                </script>
            </div>

        </div>
    </div>
    
@endsection
