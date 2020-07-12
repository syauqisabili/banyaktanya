<!-- INI MULAI BERTANYA -->
@extends('layouts.app')

@section('content')
<div class="container">
  <h3>Tuliskan pertanyaan umum</h3>

  <form action="{{ route('pertanyaan.store') }}" method="post">
    @csrf
    <div class="form-group">
      <label for="question-judul">Judul</label>
      <input type="text" name="judul" class="form-control" id="question-judul" placeholder="contoh: Bagaimana cara membuat Array Multidimensi">
      <small id="judulHelp" class="form-text text-muted">Tuliskan topik pertanyaan yang spesifik</small>
    </div>
    <div class="form-group">
      <label for="question-isi">Isi Pertanyaan</label>
      <textarea name="isi_pertanyaan" id="question-isi" class="form-control"></textarea>
      <small id="isiHelp" class="form-text text-muted">Tuliskan informasi agar seseorang dapat menjawab pertanyaanmu</small>
    </div>
    <div class="form-group">
      <label for="question-tag">Tag</label>
      <input type="text" name="tag_pertanyaan" class="form-control" id="Isi_Pertanyaan" placeholder="contoh: HTML,CSS,Python, ...">
      <small id="tagHelp" class="form-text text-muted">Tambahkan sampai 5 tag untuk mendeskripsikan pertanyaanmu</small>
    </div>
    {{-- <div class="form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Dengan ini saya mengajukan pertanyaan saya</label>
    </div> --}}
    <div class="form-group">
      <button type="submit" class="btn btn-primary">Kirim</button>
    </div>
  </form>
</div>
@endsection
@push('js')
    <script src="{{ asset('plugins/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
          selector: '#question-isi'
        });  
    </script>    
@endpush