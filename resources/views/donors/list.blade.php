@extends('layout.site')
@section('content')
    <section class="row page-header">
        <div class="container">
            <h4>All Donors</h4>
        </div>
    </section>

    <section class="row gallery-content">
        <div class="container">

            <table class="table">
                <thead>
                <tr>
                    <th class="description">Donor Name</th>
                    <th class="campaign">Campaign</th>
                    <th class="currency">Currency</th>
                    <th class="amount">Amount</th>
                    <th class="date">Date</th>
                    <th class="txid">Txid</th>
                </tr>
                </thead>
                <tbody>

                    @foreach ($donors as $donor)
                        <tr class="alert" role="alert">
                            <td>
                                @if($donor->show == 2)
                                    anonymous
                                @else
                                    {{$donor->name}}
                                @endif
                            </td>
                            <td><a href="{{ route('campaign-details', $donor->campaign['slug']) }}"> {{$donor->campaign['title']}} </a></td>
                            <td>{{$donor->currency}} </td>
                            <td>{{$donor->amount}} </td>
                            <td>{{$donor->created_at}}</td>
                            <td>{{$donor->txid}}</td>
                        </tr>
                    @endforeach


                </tbody>
                <tfoot>

                </tfoot>
            </table>


        </div>
    </section>
@endsection