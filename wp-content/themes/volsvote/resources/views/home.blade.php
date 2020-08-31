{{--
  Template Name: Home
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
  @include('partials.page-header')
  <div class="splash">
    <div>
      render #volsvote event calendar
    </div>
  </div>
  @include('partials.content-page')
  @endwhile
@endsection
