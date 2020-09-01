@extends('layout.site')
@section('content')


    <section class="row page-header" style="background-image: ''{{ asset('assets/media/'.$singleCampaign->image ) }}'">
        <div class="container">
            <h4>{!! $singleCampaign -> title !!}</h4>
        </div>
    </section>

    <section class="row gallery-content">
        <div class="container">

            <div class="row">
                <div class="col-md-8 single-project single-cause">
                    <div class="featured-content">
                        <div class="carousel-inner" role="listbox">
                            <div class="item active"><img src="{{ asset('assets/media/'.$singleCampaign->image ) }}"  height="150px" alt=""></div>
                        </div>

                    </div>
                    <div class="row m0 project_title">
                        <h2 class="hhh h1 pull-left">{!! $singleCampaign -> title !!}</h2>
                        <a  href="#donate_box" class="btn-primary pull-right">Make a donation</a>
                    </div>

                    <div class="row progressBarRow">
                        <div class="row m0">
                            <div class="progress_barBox row m0">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="{{$singleCampaign->totalDonations()}}" aria-valuemin="0" aria-valuemax="100">
                                        <div class="percentage"><span class="counter">{{$singleCampaign->totalDonations()}}</span>%</div>
                                    </div>
                                </div>
                            </div>

                            <div class="fund_raises style2 row m0">
                                <div class="col-xs-4 amount_box">
                                    <h6>RAISED</h6>
                                    <h3>  ${{number_format($singleCampaign->totalDonationsAmounts(), 2, '.', '') }} </h3>
                                </div>
                                <div class="col-xs-4 amount_box text-center">

                                </div>
                                <div class="col-xs-4 amount_box text-right">
                                    <h6>goal</h6>
                                    <h3>${{number_format($singleCampaign->vlr, 0, '.', ',') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p>{{ $singleCampaign->introduction }} </p>




                    <div class="row tabs-row shortcodeBlock m0" id="tabs">

                        <ul class="nav nav-tabs hhh-tab" role="tablist">
                            <li role="presentation" class="active"><a href="#tabs1" aria-controls="tabs1" role="tab" data-toggle="tab">Project Introduction</a></li>
                            <li role="presentation"><a href="#tabs2" aria-controls="tabs2" role="tab" data-toggle="tab">Donation Records</a></li>

                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content hhh-tab-content">
                            <div role="tabpanel" class="tab-pane active" id="tabs1">
                                <h3 class="tab-heading hhh h1">Save a Starving African Child in Action!</h3>
                                $0.30 = one meal for one child<br>
                                $6.6 = one month’s lunch for one child<br>
                                9 months = school’s opening calendar<br>
                                <hr>
                                You can donate Bitcoin and ETH to help the campaign.<br>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="tabs2">
                                <table class="table table-list-search">
                                    <thead>
                                    <tr>
                                        <th>Donor Name</th>
                                        <th>Currency</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($donors as $donor)
                                        <tr>
                                            <td>
                                                @if($donor->show == 2)
                                                    anonymous
                                                @else
                                                    {{$donor->name}}
                                                @endif
                                            </td>
                                            <td>{{$donor->currency}}</td>
                                            <td>{{$donor->amount}}</td>
                                            <td>{{$donor->created_at}}</td> 
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>



                </div>
                <div class="col-md-4 sidebar cause-sidebar">

                    <div class="row m0 widget widget-similar-project widget-similar">
                        <h4 class="hhh h2"> Other Campaigns  </h4>
                        <div class="similar-project">
                            @foreach ($campaigns as $campaign)
                                @if ($campaign->campaigns_id <> $singleCampaign->campaigns_id)
                                    <div class="row cause-item education">
                                <div class="images_row row m0">
                                    <div id="causes_carousel_inner" class="carousel slide" data-ride="carousel" data-interval="3000">
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" role="listbox">
                                            <div class="item active"><img src="{{ asset('assets/media/'.$campaign->image ) }}" alt=""></div>
                                        </div>

                                    </div>
                                    <a href="{{ route('donation', $campaign->slug) }}" class="btn-primary">Make a donation</a>
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
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!--Donate Form-->
    <form action="{{ route('donation', $singleCampaign->slug) }}" method="get" class="row m0 donate_form mfp-hide" id="donate_box">
        <h3>Personal Declaration</h3>

        <label for="donate-amount01">
            <ul>
                <li>By donating to the <u>{!! $singleCampaign -> title !!}</u> you agree that no goods or services are purchased with your donation and donations are non-refundable.</li>
                <li>You confirm that the donation funds belong to you and are of legitimate origin and are not proceeds of any illegal activities.</li>
                <li>You have read and agree to the terms of our <a href="{{ route('privacy') }}" target="_blank">Privacy Policy</a>.</li>
            </ul>
        </label>
<hr>
        <div class="row">
            <div class="col-sm-1">
                <input type="checkbox" name="assign" id="donate-amount02" value="25" required>
            </div>
            <div class="col-sm-11">
                    I fully understand the above statement and I declare that the details furnished above are true and correct

            </div>
        </div>

        <div class="input-group">
            <span class="input-group-addon right">
                <button type="submit" class="btn-primary">Proceed to donate</button>
            </span>
        </div>
    </form>

@endsection
