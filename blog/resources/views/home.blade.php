<!-- Ini adalah tampilan awal -->

@extends('master')

@section('content')
<div class="Container mr-2 ml-2">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Pertanyaan Populer</h5>
      <p class="card-text">Jangan ragu untuk mulai bertanya</p>
      <a href="/question" class="btn btn-primary">Mulai Bertanya</a>
    </div>
  </div>


  <!-- Nanti list banyak pertanyaan-->
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
</div>
@endsection

@push('script')

@endpush
