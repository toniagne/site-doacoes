@extends('layout.site')
@section('title', $campaign->title)
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
                                            <h3>  ${{number_format($campaign->totalDonationsAmounts(), 2, '.', '')}} </h3>
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

                <form action="{{ route('donation-openly', $campaign->slug) }}" method="POST" class="col-md-8 checkout-form">
                    @csrf
                    <h4 class="pi">Make a Commitment</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="name">Full Name<span>*</span></label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Yours full name">
                        </div>
                        <div class="col-sm-6">
                            <label for="name">Identification<span>*</span></label>
                            <select name="show" class="form-control">
                                <option value="1">Show Name</option>
                                <option value="2">Show as anonymous</option>
                            </select>
                        </div>
                    </div>

                     <div class="row">
                         <div class="col-sm-12">
                             <label for="email">E-mail<span>*</span></label>
                             <input type="email" name="email" id="name" class="form-control" placeholder="E-mail">
                         </div>
                     </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <label for="currences">Select Cryptocurrency<span>*</span></label>
                            <select name="currency" id="currences" class="form-control">
                                <option value="BTC">BTC - Bitcoin</option>
                                <option value="ETH">ETH - Ethereum</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="amount">Amount <span>*</span></label>
                            <input type="text" name="amount" id="amount" class="form-control money2" placeholder="Net Amount (without transaction fee)">
                        </div>
                    </div>

                    <input type="submit" value="donate now" class="btn-primary">

                </form>


            </div>
        </div>
    </section>

@push('script')
    <script src="{{ asset('js/jquery.mask.js') }}" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            $('.money2').mask('0ZZ.00000000', {
                translation: {
                    'Z': {
                        pattern: /[0-9]/, optional: true
                    }
                }
            });
        });
    </script>
@endpush
@endsection