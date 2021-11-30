@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        @if (\Session::has('msg'))
            <div class="alert alert-success">
                {!! \Session::get('msg') !!}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <ul class="nav nav-tabs bg-light" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="ticket-tab" data-toggle="tab" href="#ticket" role="tab" aria-controls="ticket"
                    aria-selected="true">Mano rezervuoti bilietai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="ticket1-tab" data-toggle="tab" href="#ticket1" role="tab"
                    aria-controls="ticket1" aria-selected="true">Mano apmokėti bilietai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="prifle-tab" data-toggle="tab" href="#prifle" role="tab" aria-controls="prifle"
                    aria-selected="false">Profilio redagavimas</a>
            </li>
        </ul>
        <div class="tab-content bg-light p-3" id="myTabContent">
            <div class="tab-pane fade show active" id="ticket" role="tabpanel" aria-labelledby="ticket-tab">
                <table class="table table-hover bg-light">
                    <thead>
                        <tr>
                            <th scope="col">Skrydis</th>
                            <th scope="col">Išvykimo data</th>
                            <th scope="col">Iš oro uosto</th>
                            <th scope="col">Į oro uosto</th>
                            <th scope="col">Statusas</th>
                            <th scope="col">Kaina</th>
                            <th scope="col">Pirkti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets->where('status', 'Rezervuotas') as $ticket)
                            <tr>
                                <td>{{ $ticket->flight->id }}</td>
                                <td>{{ $ticket->flight->departure_time }}</td>
                                <td>{{ $ticket->flight->airport_from->name }}</td>
                                <td>{{ $ticket->flight->airport_to->name }}</td>
                                <td>{{ $ticket->status }}</td>
                                <td>{{ $ticket->flight->tickets_price }} €</td>
                                <td>
                                    @if ($ticket->status == 'Rezervuotas')
                                        <button type="button" class="btn btn-secondary" data-toggle="modal"
                                            data-target="#exampleModal">
                                            Pirkti bilietą
                                        </button>
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Apmokėjimas</h5>
                                                    </div>
                                                    <form role="form" action="{{ route('stripe.post') }}" method="post"
                                                        class="require-validation" data-cc-on-file="false"
                                                        data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                                        id="payment-form">
                                                        @csrf
                                                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                                        <input type="hidden" name="price"
                                                            value="{{ $ticket->flight->tickets_price }}">
                                                        <div class="modal-body">
                                                            <div class='form-row row'>
                                                                <div class='col-lg-6 form-group required'>
                                                                    <label class='control-label'>Name on Card</label>
                                                                    <input class='form-control' type='text'>
                                                                </div>
                                                                <div class='col-lg-6 form-group required'>
                                                                    <label class='control-label'>Card Number</label>
                                                                    <input autocomplete='off'
                                                                        class='form-control card-number' type='text'>
                                                                </div>
                                                            </div>

                                                            <div class='form-row row'>
                                                                <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                                    <label class='control-label'>CVC</label> <input
                                                                        autocomplete='off' class='form-control card-cvc'
                                                                        placeholder='ex. 311' size='4' type='text'>
                                                                </div>
                                                                <div
                                                                    class='col-xs-12 col-md-4 form-group expiration required'>
                                                                    <label class='control-label'>Expiration
                                                                        Month</label> <input
                                                                        class='form-control card-expiry-month'
                                                                        placeholder='MM' size='2' type='text'>
                                                                </div>
                                                                <div
                                                                    class='col-xs-12 col-md-4 form-group expiration required'>
                                                                    <label class='control-label'>Expiration
                                                                        Year</label>
                                                                    <input class='form-control card-expiry-year'
                                                                        placeholder='YYYY' size='4' type='text'>
                                                                </div>
                                                            </div>

                                                            <div class='form-row row'>
                                                                <div class='col-md-12 error form-group d-none'>
                                                                    <div class='alert-danger alert'>Please correct
                                                                        the
                                                                        errors and try
                                                                        again.</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Atšaukti</button>
                                                            <button type="submit" class="btn btn-success">Apmokėti</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="ticket1" role="tabpanel" aria-labelledby="ticket1-tab">
                @if ($tickets->where('status', 'Apmokėtas'))
                    <table class="table table-hover bg-light">
                        <thead>
                            <tr>
                                <th scope="col">Skrydis</th>
                                <th scope="col">Išvykimo data</th>
                                <th scope="col">Iš oro uosto</th>
                                <th scope="col">Į oro uosto</th>
                                <th scope="col">Statusas</th>
                                <th scope="col">Kaina</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets->where('status', 'Apmokėtas') as $ticket)
                                <td>{{ $ticket->flight->id }}</td>
                                <td>{{ $ticket->flight->departure_time }}</td>
                                <td>{{ $ticket->flight->airport_from->name }}</td>
                                <td>{{ $ticket->flight->airport_to->name }}</td>
                                <td>{{ $ticket->status }}</td>
                                <td>{{ $ticket->flight->tickets_price }} €</td>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    Nėra apmokėtų bilietų
                @endif
            </div>
            <div class="tab-pane fade" id="prifle" role="tabpanel" aria-labelledby="prifle-tab">
                <div class="container p-3">
                    <form action="{{ route('email') }}" method="POST">
                        @csrf
                        <h2>El. pašto keitimas</h2>
                        <div class="form-group row align-items-center">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Esamas el. pašto adresas</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                    value="{{ auth()->user()->email }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Naujas el pašto adresas</label>
                            <input type="email" class="form-control" id="formGroupExampleInput" name="email">
                        </div>
                        <button type="submit" class="btn btn-secondary">Atnaujinti</button>
                    </form>
                    <form action="{{ route('password') }}" method="POST" class="mt-4">
                        @csrf
                        <h2>Slaptažodžio keitimas</h2>
                        <div class="form-group">
                            <label for="formGroupExampleInput1">Naujas slaptažodis</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Pakartokite naują slaptažodį</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-secondary">Atnaujinti</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">
        $(function() {
            var $form = $(".require-validation");
            $('form.require-validation').bind('submit', function(e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('d-none');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('d-none');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('d-none')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });
    </script>
@endsection
