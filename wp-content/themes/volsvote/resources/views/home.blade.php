{{--
  Template Name: Home
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
  @include('partials.page-header')
  <div class="splash">
    <div>
      @php
        echo do_shortcode('[utk_calendar]');
      @endphp
    </div>
  </div>
  @include('partials.content-page')
  @endwhile
@endsection
