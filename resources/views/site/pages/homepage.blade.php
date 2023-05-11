@extends('site.app')
@section('title', 'Homepage')
@section('content')

    <div class="flex flex-wrap lg:pr-1 lg:px-1 lg:py-2">
        <div class="w-full sm:w-6/6 bg-b-400 text-center text-gray-700">
            <div class="py-3">
                <div class="mx-auto">
                    <div class="bg-white px-5 text-black overflow-hidden shadow-xl sm:rounded-lg">
                        <br>
                        <div class="m-9">
                        <h1 style="font-family:	Goudy Old Style">Welcome to Polin's Store</h1>
                        <h3 style="font-family:Brush Script MT">Smartphones</h3><br>
                            </div>
                        <div class=" pb-26">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                  <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                                  <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                                  <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                                  <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>

                                </ol>
                                <div class="carousel-inner">
                                  <div class="carousel-item active">
                                    <img src="/images/image1.png" class="d-inline w-80 h-64" alt="...">
                                  </div>
                                  <div class="carousel-item">
                                    <img src="/images/image2.png" class="d-inline w-80  h-64" alt="...">
                                  </div>
                                  <div class="carousel-item">
                                    <img src="/images/image3.png" class="d-inline w-80  h-64" alt="...">
                                  </div>
                                  <div class="carousel-item">
                                    <img src="/images/image4.png" class="d-inline w-80  h-64" alt="...">
                                  </div>
                                  <div class="carousel-item">
                                    <img src="/images/image5.png" class="d-inline w-80  h-64" alt="...">
                                  </div>
                                </div>

                                <a class="carousel-control-prev " href="#carouselExampleIndicators" role="button" data-slide="prev">
                                  <span class="carousel-control-prev-icon bg-black" aria-hidden="true"></span>
                                  <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                  <span class="carousel-control-next-icon bg-black" aria-hidden="true"></span>
                                  <span class="sr-only">Next</span>
                                </a>
                              </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
