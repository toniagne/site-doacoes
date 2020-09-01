@extends('layout.site')
@section('title', 'ABOUT US')
@section('content')

    <section class="row page-header">
        <div class="container">
            <h4> {!! $about->title !!}</h4>
        </div>
    </section>

    <section class="row content_about page-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 who_we_are">
                    <h6 class="label label-defatult about_var">who we are</h6>
                    <h3 class="team_page_title">we are helping hands</h3>
                    <p class="team_page_para about_var"> {!! $about->introduction !!}</p>
                </div>
                <div class="col-sm-6 history">
                    <h6 class="label label-defatult">what we do</h6>
                    <div class="history_carousel">
                        <div class="item">
                            <h3 class="year">Sponsor a child</h3>
                            <p>Every child deserves the best start in life and the opportunity to build a successful future. Through donations we provide a solution for quality education for underprivileged children.

                                </p>
                            <p>Only 1 in 5 children in the world attend primary school and less than 1% complete secondary school. You can help us change that. Sponsoring a child can make a real difference in their lives and provide them with access to education and a better and brighter future. Your donation can help us finance school fees, buy uniforms, buy educational items and stationery, but above all, it guarantees the future of our wonderful children.</p>
                        </div>
                        <div class="item">
                            <h3 class="year">Conservation of Life</h3>
                            <p>With the support of vital investors and donors, we can take aid and basic health services more broadly, become apparent after the tragic and unnecessary deaths of children in the world.</p>

                        </div>

                    </div>
                </div>
            </div>

            <div class="row mission_vision">
                <div class="col-sm-4">
                    <i class="fa fa-gratipay"></i>
                    <h5>Grass Root-Based</h5>
                    <p>
                        Assistance and development work is community based. Our team resides in grassroots communities - live with them, learn from them, listen to them and work alongside them to find solutions to their problems. An independent board exercises overall governance leadership, managing risks and ensuring compliance with legal requirements.
                    </p>
                </div>
                <div class="col-sm-4">
                    <i class="fa fa-star"></i>
                    <h5>Focus on Children</h5>
                    <p>All development work that we perform focus on children - the bright young minds of tomorrow.</p>
                </div>
                <div class="col-sm-4">
                    <i class="fa fa-thumbs-up"></i>
                    <h5>Partnering for Change</h5>
                    <p>
                        We partner with communities, children, government, civil society, corporations, academia and religious organizations to build an ideal nation for children.
                    </p>
                </div>
            </div>


            <div class="row how-fund-help-children">
                <h3>MAKE A DIFFERENCE, MAKE A DONATION AND CHANGE A CHILD'S FUTURE.</h3>
                <a href="{{ route('campaigns-list') }}" class="pull-right btn-primary">make a donation</a>
            </div>
        </div>
    </section>


@endsection
