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

                <form id="form" action="" method="POST" class="col-md-8 checkout-form">
                    @csrf
                    <div class="row m0 widget widget-similar-project widget-similar">
                        <h4 class="hhh h2">Leave Your Name</h4>
                        <div class="similar-project">
                            <!--Event-->

                           <div class="row">
                               <div class="col-sm-2">  <h4> Name: </h4> </div>
                               <div class="col-sm-10"> <h4> {{ $donor->name }}</h4> </div>

                               <div class="col-sm-2">  <h4> Date: </h4> </div>
                               <div class="col-sm-10"> <h4> {{ date('Y-m-d') }}</h4> </div>

                               <div class="col-sm-2">  <h4> Donation: </h4> </div>
                               <div class="col-sm-10"> <h4> {{ $donor->amount }} {{ $donor->currency }}</h4> </div>

                               <div class="col-sm-2">  <h4> To: </h4> </div>
                               <div class="col-sm-10"> <h4>
                                       {{ Config::get('app.payments_config.'.$donor->currency) }}

                                   </h4> </div>
                           </div>
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-sm-10">
                                    <input type="text" name="txid" id="txid" class="form-control" placeholder="Txid">
                                    <span id="error"></span>
                                    <div id="loading" title="my ajax loading dialog" > </div>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" id="info" class="btn-primary btn-outline hmfw"><i class="fa fa-info" id="info" aria-hidden="true"></i></button>

                                </div>

                                <div class="col-sm-12">
<hr>
                                    <p class="team_page_para about_var" id="message"></p>
                                </div>
                            </div>


                        </div>
                        <br><Br>


                        <button type="submit" class="btn-primary hmfw">Done</button>

                    </div>
                </form>



            </div>
        </div>
    </section>
    @push('script')
        <script type="text/javascript" src="{{ asset('js/jquery.validate.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#info").click(function(){
                    $("#message").html("You Txid will help us to relate your commitment with actual transfer record.");
                });

                $('#form').validate({
                    submitHandler: function( form ){
                        var dados = $( form ).serialize();
                        $.ajax({
                            type: "POST",
                            data: {
                                txid: $('#txid').val(),
                                donor_id:{{$donor->donors_id}},
                                currency:"{{$donor->currency}}"
                            },
                            beforeSend: function(){
                                $("#error").html("");
                                $("#loading").html("Wait a moment, checking your Txid...");
                            },
                            success: function( data )
                            {
                                $("#loading").html(" ");
                                    if (data.txid == false){
                                        $("#error").html("Invalid Txid number");
                                    } else {
                                        window.location.href = "{{ route('donation-done', $donor->donors_id) }}";
                                    }
                            }
                        });

                        return false;
                    }
                });
            });

        </script>


    @endpush
@endsection