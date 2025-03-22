@extends('user.components.base', ['title' => 'Test Detail'])
@section('content')
    <header id="top-navbar" class="top-navbar">
        <div class="container">
            <div class="top-navbar_full">
                <div class="back-btn d-flex align-items-center">
                    <a href="javascript: history.go(-1)"><img src="{{ asset('assets/images/forget-password-screen/back-btn.svg') }}"
                            alt="back-btn-img"></a>
                </div>
                <div class="top-navbar-title d-flex align-items-center">
                    <p>Detail Test Result</p>
                </div>
            </div>
        </div>
        <div class="navbar-boder"></div>
    </header>

    <section id="test-sec">
        <div class="homepage2-fourth-sec mt-24">
            <div class="container">
                <div class="test-detail">
                    <div class="score">
                        <h3 class="score-title-danger mt-5">20<span>pt</span></h3>
                        <h3 class="score-title-safe mt-5">20<span>pt</span></h3>
                        <div class="d-flex justify-content-center align-items-center mt-3">
                            <div class="score-danger me-2"></div>
                            <p class="score-subtitle">High Risk</p>
                        </div>
                        <div class="d-flex justify-content-center align-items-center mt-3">
                            <div class="score-safe me-2"></div>
                            <p class="score-subtitle">Low Risk</p>
                        </div>
                    </div>
                    <div class="risk-bars">
                        <div class="bar high-risk"></div>
                        <div class="bar high-risk"></div>
                        <div class="bar high-risk"></div>
                        <div class="bar high-risk"></div>
                        <div class="bar high-risk"></div>
                        <div class="bar high-risk"></div>
                        <div class="bar high-risk"></div>
                        <div class="bar default"></div>
                        <div class="bar default"></div>
                        <div class="bar default"></div>
                    </div>
                    <div class="risk-bars">
                        <div class="bar low-risk"></div>
                        <div class="bar low-risk"></div>
                        <div class="bar low-risk"></div>
                        <div class="bar low-risk"></div>
                        <div class="bar low-risk"></div>
                        <div class="bar low-risk"></div>
                        <div class="bar low-risk"></div>
                        <div class="bar default"></div>
                        <div class="bar default"></div>
                        <div class="bar default"></div>
                    </div>
                    <div class="info-test">
                        <div class="risk d-flex justify-content-center align-items-center">
                            <div class="d-flex justify-content-center align-items-center mt-3 me-5">
                                <div class="score-safe me-2"></div>
                                <p class="score-subtitle">&lt;16 Low Risk</p>
                            </div>
                            <div class="d-flex justify-content-center align-items-center mt-3">
                                <div class="score-danger me-2"></div>
                                <p class="score-subtitle">&gt;16 High Risk</p>
                            </div>
                        </div>
                        <p class="score-info-subtitle">Score Tinggi: Segera dilakukan perawatan di Rumah Sakit</p>
                    </div>
                    <div class="answer-test mt-5">
                        <div class="card mb-3 answer-test-card">
                            <div class="card-body">
                                <div class="text-start">
                                    <p class="answer-test-title mb-3">Umur</p>
                                    <p class="answer-test-subtitle">20 <span>Tahun</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 answer-test-card">
                            <div class="card-body">
                                <div class="text-start">
                                    <p class="answer-test-title mb-3">Tekanan Darah (Sistole) > 140</p>
                                    <p class="answer-test-subtitle">Ya</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
