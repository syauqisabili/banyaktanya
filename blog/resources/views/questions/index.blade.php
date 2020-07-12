@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center mt-3">
            <div class="col-md-2">
                <h2>Tags</h2>
            </div>
            <div class="col-md-8">
                <div class="d-flex justify-content-between">
                    <h2>Questions</h2>
                    <a href="{{ route('pertanyaan.create') }}"><span class="btn btn-primary btn-sm">Buat Pertanyaan</span></a>
                </div>
                <div class="d-flex flex-wrap jsutify-content-left my-4">
                    @foreach ($items as $item)
                        <div class="bg-white p-3 shadow-sm w-100 rounded mb-3">
                            <h4>{{ $item->judul }}</h4>
                            @php
                                echo html_entity_decode($item->isi_pertanyaan);
                            @endphp 
                            <p><a href="{{ route('pertanyaan.show', [$item->id]) }}">Lihat Detail</a> <span class="d-inline-block ml-3">{{ count($item->answers) }} Jawaban</span></p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection