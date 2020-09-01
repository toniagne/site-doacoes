
@extends('layout.site')
@section('content')
@section('title', 'HOME')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css')}}">
@endpush
    <style>
        canvas {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }
    </style>
    <section class="row featured_news">
        @foreach ($slides as $slide)
            <div class="item">
                <img src="{{ asset('assets/media/'.$slide->image_slide ) }}" class="img-fluid" alt="">
                <div class="row caption m0">
                    <div class="container">
                        <div class="volunteer_summery_box col-lg-4 col-md-10">
                            <h6 class="label label-default white">Can you help us ?</h6>
                            <h3 class="news-title"><a href="single.html">{{ $slide->title  }}</a></h3>
                            <p>{{ $slide->introduction  }}</p>
                            <a href="{{ route('campaign-details', $slide->slug) }}" class="btn-primary">Donate to this campaign</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

    <section class="row how_help3">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 how_help_post">
                    <h6 class="label label-defatult">Can you help us ?</h6>
                    <h3 class="this_title"><a href="#">DID YOU KNOW IT IS POSSIBLE TO HELP NEARLY FAMILIES DIRECTLY.</a></h3>
                    <p>There are only two days in the year that nothing can be done. One is called yesterday and the other is called tomorrow, so today is the right day to love, believe, do and especially live.<br>
                    <i>"-Dalai Lama"</i>
                    </p>
                    <a href="{{ route('donors', 'all') }}" class="btn-primary white">Donation</a>
                </div>
                <div class="col-sm-6">
                    <div class="media help-process3">
                        <div class="media-left">
                            <span><img src="{{ asset('images/help04.png')}}" alt=""></span>
                        </div>
                        <div class="media-body">
                            <h5>Make a donation.</h5>
                            <p>Become a hero for the more than 385 million children living in poverty.</p>
                        </div>
                    </div>
                    <div class="media help-process3">
                        <div class="media-left">
                            <span><img src="{{ asset('images/help05.png')}}" alt=""></span>
                        </div>
                        <div class="media-body">
                            <h5>Be a volunteer</h5>
                            <p>You can participate in a child's life through a simple donation.</p>
                        </div>
                    </div>
                    <div class="media help-process3">
                        <div class="media-left">
                            <span><img src="{{ asset('images/help06.png')}}" alt=""></span>
                        </div>
                        <div class="media-body">
                            <h5>Social projects</h5>
                            <p>Donations finance social projects and activities in which children and their families participate.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="row our_casuses style2">
        <div class="container">
            <div class="row sectionTitle text-center">
                <h6 class="label label-default">our campaigns</h6>
                <h3>WE HELP THOUSANDS OF CHILDREN TO GET YOUR EDUCATION NOW WE NEED YOUR HELP TO CONTINUE </h3>
            </div>
            <div class="row">
                <div class="causes_carousel style2">
                    @foreach ($campaigns as $singleCampaign)
                        <div class="item">
                            <div class="images_row row m0">
                                <div id="causes_carousel_inner" class="carousel slide" data-ride="carousel" data-interval="3000">
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                        <div class="item active"><img src="{{ asset('assets/media/'.$singleCampaign->image ) }}"  height="150px" alt=""></div>
                                    </div>

                                </div>
                                <a href="{{ route('donation', $singleCampaign->slug) }}" class="btn-primary">make a donation</a>
                            </div>
                            <div class="cause_excepts row m0">
                                <h4 class="cuase_title"><a href="{{ route('campaign-details', $singleCampaign->slug) }}">{{ $singleCampaign->title }}</a></h4>
                                <p>{{ $singleCampaign -> introduction }}</p>
                                <div class="row fund_progress m0">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="{{$singleCampaign->totalDonations()}}" aria-valuemin="0" aria-valuemax="100">
                                            <div class="percentage"><span class="counter">{{$singleCampaign->totalDonations()}}</span>%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>



    <section class="row latest_news">
        <div class="container">
            <div class="row sectionTitle text-center">
                <h6 class="label label-default">OUR STATISTICS</h6>
                <h3>Donation statistics, affected victims</h3>
            </div>
            <div class="row">
                <div class="col-sm-12">

                    <canvas id="barChart"></canvas>


                </div>



            </div>
        </div>
    </section>


    <section class="row beVolunteer text-center">
        <div class="container beVolunteerBox">
            <div class="row sectionTitle text-center">
                <h6 class="label label-default">Our Donors</h6>
                <h3>Donations Map</h3>
            </div>
            <a href="{{ route('donors') }}" class="btn-primary">meet our donors</a>
        </div>
    </section>


@push('script')
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
    <script type="text/javascript">
        //bar
        var ctxB = document.getElementById("barChart").getContext('2d');
        var myBarChart = new Chart(ctxB, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($campaigns as $campaign)
                    "{{$campaign->title}}",
                    @endforeach
                ],
                datasets: [{
                    label: '# of affected victims',
                    data: [
                        @foreach ($campaigns as $campaign)
                        {{$campaign->victims}},
                        @endforeach
                    ],
                    backgroundColor: [
                        @foreach ($campaigns as $campaign)
                        'rgba({{$campaign->color}}, 0.2)',
                        @endforeach
                    ],
                    borderColor: [
                        @foreach ($campaigns as $campaign)
                        'rgba(255,99,132,1)',
                        @endforeach
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endpush

@endsection
