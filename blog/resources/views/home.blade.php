
<!-- Ini adalah tampilan awal -->

@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
        <div class="col-6 col-sm-4">
        </div>
        <div class="col-6 col-sm-4">
          <div class="card" style="width: auto;" >
            <div class="card-body">
              <h5 class="card-title">Apa yang sedang kamu bingungkan?</h5>
              <p class="card-text">Jangan ragu untuk mulai bertanya</p>
              <a href="{{ route('pertanyaan.create') }}" class="btn btn-primary">Mulai Bertanya</a>
            </div>
          </div>
        </div>
        <div class="col-6 col-sm-4">
        </div>
    </div>
</div>
  <!-- Nanti list banyak pertanyaan-->

@endsection

@push('script')

@endpush
