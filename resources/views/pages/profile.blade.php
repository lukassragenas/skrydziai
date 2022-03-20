@extends('layouts.master')

@section('content')

    <section class="home-section d-flex align-items-top">
        <div class="container">
            <div class="row py-5 fade-right">
                <div class="col-md-12 mx-auto my-5 text-white text-uppercase">
                    <div class="my-profile pt-5">
                        <div class="container-fluid mt-5">
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
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="ticket-tab" href="{{ route('reserved') }}">Mano
                                        rezervuoti bilietai</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="ticket1-tab" href="{{ route('paid') }}">Mano apmokėti
                                        bilietai</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="prifle-tab" href="{{ route('profile') }}">Profilio
                                        redagavimas</a>
                                </li>
                            </ul>
                            <div class="card p-3" id="myTabContent">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="align-middle" scope="col">Skrydis</th>
                                            <th class="align-middle" scope="col">Išvykimo data</th>
                                            <th class="align-middle" scope="col">Iš oro uosto</th>
                                            <th class="align-middle" scope="col">Į oro uosto</th>
                                            <th class="align-middle" scope="col">Statusas</th>
                                            <th class="align-middle" scope="col">Kaina</th>
                                            <th class="align-middle" scope="col">Pirkti</th>
                                            <th class="align-middle" scope="col">Atšaukti rezervaciją</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ticketsReserved as $ticket)
                                            <tr>
                                                <td class="align-middle">{{ $ticket->flight->id }}</td>
                                                <td class="align-middle">{{ $ticket->flight->departure_time }}</td>
                                                <td class="align-middle">{{ $ticket->flight->airport_from->name }}</td>
                                                <td class="align-middle">{{ $ticket->flight->airport_to->name }}</td>
                                                <td class="align-middle">{{ $ticket->status }}</td>
                                                <td class="align-middle">{{ $ticket->flight->tickets_price }} €</td>
                                                <td class="align-middle">
                                                    <button type="button" class="primary-btn-2" data-toggle="modal"
                                                        data-target="#modal{{ $ticket->id }}">
                                                        Pirkti bilietą
                                                    </button>
                                                    <div class="modal fade" id="modal{{ $ticket->id }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="modalLabel-{{ $ticket->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="ModalLabel-{{ $ticket->id }}">
                                                                        Apmokėjimas</h5>
                                                                </div>
                                                                <form role="form" action="{{ route('stripe.post') }}"
                                                                    method="post"
                                                                    class="require-validation{{ $ticket->id }}"
                                                                    data-cc-on-file="false"
                                                                    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                                                    id="payment-form-{{ $ticket->id }}">
                                                                    @csrf
                                                                    <input type="hidden" name="ticket_id"
                                                                        value="{{ $ticket->id }}">
                                                                    <div class="modal-body">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox"
                                                                                class="custom-control-input"
                                                                                id="customCheck-{{ $ticket->id }}"
                                                                                name="example1">
                                                                            <label class="custom-control-label"
                                                                                for="customCheck-{{ $ticket->id }}">Domina
                                                                                kelionės draudimas?Nerizikuokite!
                                                                                Apsidrauskite
                                                                                medicininių išlaidų ar nelaimingų atsitikimų
                                                                                draudimu
                                                                                visos kelionės metu ir išvenkite
                                                                                rūpesčių.</label>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="form-group">
                                                                            <label for="price"
                                                                                class="control-label pl-2">Dabartinė
                                                                                kelionės
                                                                                kaina:</label>
                                                                            <input style="color:#000 !important" type="text"
                                                                                readonly class="form-control-plaintext"
                                                                                id="price-{{ $ticket->id }}" name="price"
                                                                                value="{{ $ticket->flight->tickets_price }}">
                                                                        </div>
                                                                        <hr>
                                                                        <div class='form-row row'>
                                                                            <div class='col-lg-6 form-group required'>
                                                                                <label class='control-label'>Vardas</label>
                                                                                <input class='form-control'
                                                                                    style="width: 367px !important"
                                                                                    type='text'>
                                                                            </div>
                                                                            <div class='col-lg-6 form-group required'>
                                                                                <label class='control-label'>Kortelės
                                                                                    nr.</label>
                                                                                <input autocomplete='off'
                                                                                    class='form-control card-number{{ $ticket->id }}'
                                                                                    type='text'
                                                                                    style="width: 367px !important">
                                                                            </div>
                                                                        </div>

                                                                        <div class='form-row row mt-4'>
                                                                            <div
                                                                                class='col-xs-12 col-md-4 form-group cvc required'>
                                                                                <label class='control-label'>CVC</label>
                                                                                <input autocomplete='off'
                                                                                    class='form-control card-cvc{{ $ticket->id }}'
                                                                                    placeholder='ex. 311' size='4'
                                                                                    type='text'>
                                                                            </div>
                                                                            <div
                                                                                class='col-xs-12 col-md-4 form-group expiration required'>
                                                                                <label class='control-label'>Galiojimo
                                                                                    mėn</label> <input
                                                                                    class='form-control card-expiry-month{{ $ticket->id }}'
                                                                                    placeholder='MM' size='2' type='text'>
                                                                            </div>
                                                                            <div
                                                                                class='col-xs-12 col-md-4 form-group expiration required'>
                                                                                <label class='control-label'>Galiojimo
                                                                                    metai</label>
                                                                                <input
                                                                                    class='form-control card-expiry-year{{ $ticket->id }}'
                                                                                    placeholder='YYYY' size='4' type='text'>
                                                                            </div>
                                                                        </div>

                                                                        <div class='form-row row'>
                                                                            <div class='col-md-12 error form-group d-none'>
                                                                                <div class='alert-danger alert'>Įveskite
                                                                                    teisingus duomenis ir bandykite dar
                                                                                    kartą</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <script>
                                                                        let price{{ $ticket->id }} = $('#payment-form-{{ $ticket->id }} #price-{{ $ticket->id }}').val();
                                                                        $('#customCheck-{{ $ticket->id }}').change(function() {
                                                                            if ($(this).is(":checked")) {
                                                                                let newPrice = price{{ $ticket->id }} * 1.05;
                                                                                var amt = parseFloat(newPrice);
                                                                                $('#payment-form-{{ $ticket->id }} #price-{{ $ticket->id }}').val(amt.toFixed(2));
                                                                            } else {
                                                                                $('#payment-form-{{ $ticket->id }} #price-{{ $ticket->id }}').val(price{{ $ticket->id }});
                                                                            }
                                                                        });
                                                                    </script>
                                                                    <script type="text/javascript">
                                                                        $(function() {
                                                                            var $form = $(".require-validation{{ $ticket->id }}");
                                                                            $('form.require-validation{{ $ticket->id }}').bind('submit', function(e) {
                                                                                var $form = $(".require-validation{{ $ticket->id }}"),
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
                                                                                        number: $('.card-number{{ $ticket->id }}').val(),
                                                                                        cvc: $('.card-cvc{{ $ticket->id }}').val(),
                                                                                        exp_month: $('.card-expiry-month{{ $ticket->id }}').val(),
                                                                                        exp_year: $('.card-expiry-year{{ $ticket->id }}').val()
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
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="primary-btn-3 mr-4"
                                                                            data-dismiss="modal">Atšaukti</button>
                                                                        <button type="submit"
                                                                            class="primary-btn">Apmokėti</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <form action="{{ route('delete', ['id' => $ticket->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" value="{{ $ticket->id }}">
                                                        <button type="submit" class="primary-btn">Atšaukti
                                                            rezervaciją</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $ticketsReserved->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>


@endsection
@section('scripts')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
@endsection
