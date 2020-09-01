@extends('layout.site')
@section('title', 'OUR CAUSES')
@section('content')


    <section class="row page-header">
        <div class="container">
            <h4>our causes</h4>
        </div>
    </section>

    <section class="row gallery-content">
        <div class="container">
            <div class="row sectionTitle text-center">
                <h6 class="label label-default">how you could help</h6>
                <h3>WE NEED YOUR HELP TO HELP OTHERS, SEE OUR CAUSES gallery</h3>
            </div>

            <div class="row">
                <div class="causes_container popup-gallery">
                    <div class="grid-sizer"></div>
                    @foreach ($campaigns as $campaing)
                        <div class="col-sm-12 cause-item list-item education">
                        <div class="images_row pull-left">
                            <img src="{{ asset('assets/media/'.$campaing->image ) }}" alt="">
                        </div>
                        <div class="cause_excepts pull-left">
                            <h4 class="cuase_title">
                                <a href="{{ route('campaign-details', $campaing->slug) }}">{{ $campaing->title }}</a></h4>
                            <p>{{ $campaing->introduction }}</p>
                        </div>
                        <div class="fund_raise_info pull-left">
                            <div class="row m0 text-center">
                                <a href="{{ route('donation', $campaing->slug) }}" class="btn-primary btn-outline">More details</a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

            </div>
        </div>
    </section>


@endsection
