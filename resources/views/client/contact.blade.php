@extends('client.layouts.app')

@section('content')
<section class="home-slider owl-carousel">

    <div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text justify-content-center align-items-center">

          <div class="col-md-7 col-sm-12 text-center ftco-animate">
              <h1 class="mb-3 mt-5 bread">Contact Us</h1>
              <p class="breadcrumbs"><span class="mr-2"><a href="{{route('home')}}">Home</a></span> <span>Contact</span></p>
          </div>

        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section contact-section">
    <div class="container mt-5">
      <div class="row block-9">
                  <div class="col-md-4 contact-info ftco-animate">
                      <div class="row">
                          <div class="col-md-12 mb-4">
                <h2 class="h4">Contact Information</h2>
              </div>
              <div class="col-md-12 mb-3">
                <p><span>Address:</span> Ton Dan Street,Cam Le,Da Nang,VN</p>
              </div>
              <div class="col-md-12 mb-3">
                <p><span>Phone:</span> <a href="tel://1234567920">+ 0914219941</a></p>
              </div>
              <div class="col-md-12 mb-3">
                <p><span>Email:</span> <a href="mailto:info@yoursite.com">d01295306466@gmail.com</a></p>
              </div>
                      </div>
                  </div>
                  <div class="col-md-1"></div>
        <div class="col-md-6 ftco-animate">
          <form id="form_contact" class="contact-form">
            @csrf
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                  <input name="name" type="text" class="form-control" placeholder="Your Name">
                  <div id="errorname"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                  <input name="email" type="text" class="form-control" placeholder="Your Email">
                  <div id="erroremail"></div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <input name="subject" type="text" class="form-control" placeholder="Subject">
              <div id="errorsubject"></div>
            </div>
            <div class="form-group">
              <textarea name="message" id="textarea" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
              <div id="errormessage"></div>
            </div>
            <div class="form-group">
              <button type="submit" id="submit" class="btn btn-primary py-3 px-5">Send Message</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection