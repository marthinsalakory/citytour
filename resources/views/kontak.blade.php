@extends('layouts.main')

@section('content')

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('{{ url('/') }}/nova/assets/img/contact-header.jpg');">
        <div class="container position-relative d-flex flex-column align-items-center">
            @include('layouts.alert')
            <h2>Contact</h2>
            <ol>
                <li><a href="index.html">Home</a></li>
                <li>Contact</li>
            </ol>

        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container position-relative" data-aos="fade-up">

            <div class="row gy-4 d-flex justify-content-end">

                <div class="col-lg-5" data-aos="fade-up" data-aos-delay="100">

                    <div class="info-item d-flex">
                        <i class="bi bi-geo-alt flex-shrink-0"></i>
                        <div>
                            <h4>Location:</h4>
                            <p>Ambon</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="info-item d-flex">
                        <i class="bi bi-envelope flex-shrink-0"></i>
                        <div>
                            <h4>Email:</h4>
                            <p>marthinsalakory11@gmail.com</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="info-item d-flex">
                        <i class="bi bi-phone flex-shrink-0"></i>
                        <div>
                            <h4>Call:</h4>
                            <p>+6281318812927</p>
                        </div>
                    </div><!-- End Info Item -->

                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">

                    <form action="{{route('kontak')}}" method="post" role="form" class="php-email-form-failed">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required value="{{old('name')}}">
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required value="{{old('email')}}">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required value="{{old('subject')}}">
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message" required>{!! old('message') !!}</textarea>
                        </div>
                        <div class="my-3">
                            {{-- <div class="loading">Loading</div> --}}
                            <div class="error-message"></div>
                            @if (session('message'))
                            <div class="sent-message text-{{session('color')}}">{!! session('message') !!}</div>
                            @endif
                        </div>
                        <div class="text-center "><button class="btn btn-primary" type="submit">Send Message</button></div>
                    </form>

                </div><!-- End Contact Form -->

            </div>

        </div>
    </section><!-- End Contact Section -->

</main>

@endsection