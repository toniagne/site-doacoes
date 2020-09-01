@extends('layout.site')
@section('content')
    <section class="row page-header">
        <div class="container">
            <h4>{{ $campaign->title }}</h4>
        </div>
    </section>

    <section class="row gallery-content">
        <div class="container">
            <div class="row">
                <div class="col-md-4 sidebar checkout-sidebar">
                    <div class="row m0 widget widget-similar-project widget-similar">

                        <div class="similar-project">
                            <div class="row cause-item education">
                                <div class="images_row row m0">
                                    <div id="causes_carousel_inner" class="carousel slide" data-ride="carousel" data-interval="3000">
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" role="listbox">
                                            <div class="item active"><img src="{{ asset('assets/media/'.$campaign->image ) }}" alt=""></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cause_excepts row m0">
                                    <h4 class="cuase_title"><a href="{{ route('campaign-details', $campaign->slug) }}">{{ $campaign->title }}</a></h4>
                                    <p>{{ $campaign->introduction }}</p>
                                    <div class="row fund_progress m0">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="{{$campaign->totalDonations()}}" aria-valuemin="0" aria-valuemax="100">
                                                <div class="percentage"><span class="counter">{{$campaign->totalDonations()}}</span>%</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row fund_raises m0">
                                        <div class="pull-left raised amount_box">
                                            <h6>raised</h6>
                                            <h3>  ${{number_format($campaign->totalDonationsAmounts(), 2, '.', '')}}  </h3>
                                        </div>
                                        <div class="pull-left goal amount_box">
                                            <h6>goal</h6>
                                            <h3>${{number_format($campaign->vlr, 0, '.', ',')  }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <form action="{{ route('donation-completed', $campaign->slug) }}" method="POST" class="col-md-8 checkout-form">
                    @csrf
                    <div class="row m0 widget widget-similar-project widget-similar">
                        <h4 class="hhh h2">Fulfill Your Commitment</h4>
                        <div class="similar-project">
                            <!--Event-->

                            <div class="row countdown_block m0">
                                <div class="pull-left timer" id="upcoming-event-countdown"></div>
                            </div>
                            <Br>
                            <hr>
                            <p class="text-center">
                            <h6 class="label label-defatult about_var text-center">Commitment Statement </h6><br><br>
                            <u>{{$donor['name']}}</u> commit <u>{{ $donor['amount'] }} {{ $donor['currency'] }}</u>  to <u>{{$campaign->name}}</u> project
                            </p>
                            <input type="hidden" name="name" value="{{$donor['name']}}">
                            <input type="hidden" name="amount" value="{{$donor['amount']}}">
                            <input type="hidden" name="txid" value="0">
                            <input type="hidden" name="campaign_id" value="{{$campaign->campaigns_id}}">
                            <input type="hidden" name="email" value="{{$donor['email']}}">
                            <input type="hidden" name="show" value="{{$donor['show']}}">
                            <input type="hidden" name="currency" value="{{$donor['currency']}}">
                            <hr>
                        </div>
                        <br><Br>
                        <h6 class="label label-defatult about_var text-center">Important </h6>
                        <h5>
                            To ensure that BCF receives exact amount of <u>{{ $donor['amount'] }} {{ $donor['currency'] }}</u>,
                            please be sure to also include the transaction fee in the total amount you send.
                        </h5>
                        <blockquote class="style2">
                            <div class="row">


                                <div class="col-sm-2">
                                    <img src="{{ asset('images/'.$donor['currency'].'.png') }}">
                                </div>
                                <div class="col-sm-1"></div>
                                <div class="col-sm-9  ">
                                    {{ $donor['currency'] }} Address <br>
                                    <span id="p1" style="text-transform: none;">{{ Config::get('app.payments_config.'.$donor['currency']) }}</span><br>
                                    <br>

                                    <div class="row">
                                        <div class="col-sm-2">
                                            <button type="button" onclick="copyToClipboard('#p1')" class="btn-primary" >
                                                <span class="tooltip-r" data-toggle="tooltip" data-placement="left" title="Click the button to copy the address"><i class="fa fa-files-o" aria-hidden="true" id="copy"></i></span>
                                            </button>
                                        </div>
                                        <div class="col-sm-10">
                                            <h4>Click the button to copy the address</h4>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </blockquote>
                        <button type="submit" class="btn-primary hmfw">Transfer completed</button>

                    </div>
                </form>


            </div>
        </div>
    </section>
@push('script')
    <script src="{{ asset('vendors/countdown/jquery.countdown.min.js') }}"></script>
    <!--CounterUp-->
    <script type="text/javascript">
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");


            $temp.remove();
        }
    </script>


@endpush
@endsection