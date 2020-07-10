<!-- INI MULAI BERTANYA -->
@extends('master')

@section('content')
<div class="container">
  <h3><br>Tuliskan pertanyaan umum</h3>

  <form class="question-form" action="/answer" method="post">
    <div class="form-group">
      <label for="question-judul">Judul</label>
      <input type="judul" class="form-control" id="Judul_Pertanyaan" placeholder="contoh: Bagaimana cara membuat Array Multidimensi">
      <small id="judulHelp" class="form-text text-muted">Tuliskan topik pertanyaan yang spesifik</small>
    </div>
    <div class="form-group">
      <label for="question-isi">Isi Pertanyaan</label>
      <form method="post">
        <textarea id="mytextarea"></textarea>
      </form>
      <small id="isiHelp" class="form-text text-muted">Tuliskan informasi agar seseorang dapat menjawab pertanyaanmu</small>
    </div>
    <div class="form-group">
      <label for="question-tag">Tag</label>
      <input type="isi" class="form-control" id="Isi_Pertanyaan" placeholder="contoh: HTML, CSS, Python, ...">
      <small id="tagHelp" class="form-text text-muted">Tambahkan sampai 5 tag untuk mendeskripsikan pertanyaanmu</small>
    </div>
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Dengan ini saya mengajukan pertanyaan saya</label>
    </div>
    <button type="submit" class="btn btn-primary">Kirim</button>
  </form>
</div>
@endsection

@push('script')

@endpush
