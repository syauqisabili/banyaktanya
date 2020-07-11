
<!-- Ini adalah tampilan awal -->

@extends('layouts.app')

@section('content')
<div class="Container mr-2 ml-2">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Apa yang sedang kamu bingungkan?</h5>
      <p class="card-text">Jangan ragu untuk mulai bertanya</p>
      <a href="{{ route('pertanyaan.create') }}" class="btn btn-primary">Mulai Bertanya</a>
    </div>
  </div>


  <!-- Nanti list banyak pertanyaan-->
  <div class="row">

  </div>
  <div class="card">
  <h5 class="card-header">Featured</h5>
  <div class="card-body">
    <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>

<a class="dropdown-item" href="{{ route('logout') }}"
  onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
  {{ __('Logout') }}
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>

@endsection

@push('script')

@endpush
