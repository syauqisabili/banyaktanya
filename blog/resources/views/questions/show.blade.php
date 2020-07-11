@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-white shadow-sm rounded p-3">
            <h4>{{ $item->judul }}</h4>
            <p>{{ $item->isi_pertanyaan }}</p>
            <div class="pb-3">
                <span class="d-block"><i class="fas fa-tags"></i> 
                    @foreach ($item->tags as $tag)
                        <span class="badge badge-dark">{{ $tag->name }}</span>
                    @endforeach
                </span>
                <span class="d-block">
                    Dibuat oleh: <a href="{{ route('user.show', [$item->user_id]) }}">{{ ucwords($item->user->name) }} <small><i class="fas fa-external-link-alt"></i></small></a>
                </span>
                <span class="d-block"><small><em>{{ date('l, d F Y', strtotime($item->created_at)) }}</small></em></span>
            </div>
            @if ( $user->isOwner($item) )
                <div class="d-inline">
                    <a class="mr-1 btn btn-primary btn-sm" href="{{ route('pertanyaan.edit', [$item->id]) }}">Edit</a>
                    <form class="d-inline-block" action="{{ route('pertanyaan.destroy', [$item->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </div>
            @endif
        </div>

        <div class="bg-white shadow-sm my-3 p-3">
            <form action="{{ route('jawaban.store') }}" method="post">
                @csrf
                <input type="hidden" name="pertanyaan_id" value="{{ $item->id }}">
                <div class="form-group">
                    <label for="jawaban">Tulis Jawaban</label>
                    <textarea name="isi_jawaban" id="jawaban" cols="30" rows="5" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm">Posting Jawaban</button>
                </div>
            </form>
        </div>

        <div class="bg-white shadow-sm my-3 p-3">
            <h4 class="mb-4">{{ count($item->answers) }} Jawaban</h4>
            @if ( $item->answers != null )
                @foreach ($item->answers as $answer)
                    <div class="border-bottom {{ $answer->status == true ? 'border-success' : '' }}">
                        @php
                            echo html_entity_decode($answer->isi_jawaban); 
                        @endphp
                        <div class="pb-3">
                            <span class="d-block">
                                Dibuat oleh: <a href="{{ route('user.show', [$answer->user_id]) }}">{{ ucwords($answer->user->name) }} <small><i class="fas fa-external-link-alt"></i></small></a>
                            </span>
                            <span class="d-block"><small><em>{{ date('l, d F Y', strtotime($answer->created_at)) }}</small></em></span>
                        </div>

                        @if ( $user->isOwner($answer) )
                            <div class="d-inline-block mb-4">
                                <a class="mr-1 btn btn-primary btn-sm" href="{{ route('jawaban.edit', [$answer->id]) }}">Edit</a>
                                <form class="d-inline-block" action="{{ route('jawaban.destroy', [$answer->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        @endif
                        
                        @if ( $user->isOwner($item) )
                            <div class="d-inline-block mb-4">
                                <form class="d-inline-block" action="{{ route('jawaban.update', [$answer->id]) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-success btn-sm">Jadikan jawaban terbaik</button>
                                </form>
                            </div>
                        @endif

                        <div class="py-2">
                            @if ( $answer->comments != null )
                                @foreach ($answer->comments as $comment)
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-8 offset-md-4 border-bottom mb-3">
                                            @php
                                                echo html_entity_decode($comment->isi_komentar)
                                            @endphp
                                            <div class="pb-3">
                                                <span class="d-block">
                                                    Dibuat oleh: <a href="{{ route('user.show', [$comment->user_id]) }}">{{ ucwords($comment->user->name) }} <small><i class="fas fa-external-link-alt"></i></small></a>
                                                </span>
                                                <span class="d-block"><small><em>{{ date('l, d F Y', strtotime($comment->created_at)) }}</small></em></span>
                                            </div>

                                            @if ( $user->isOwner($comment) )
                                                <div class="d-inline-block mb-4">
                                                    <a class="mr-1 btn btn-primary btn-sm" href="{{ route('komentar.edit', [$comment->id]) }}">Edit</a>
                                                    <form class="d-inline-block" action="{{ route('komentar.destroy', [$comment->id]) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>    
                                    </div>
                                </div>
                                @endforeach
                            @endif
                            
                            <div class="row">
                                <div class="col-md-8 offset-md-4">
                                    <form action="{{ route('komentar.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="jawaban_id" value="{{ $answer->id }}">
                                        <div class="form-group">
                                            <label for="komentar">Komentar</label>
                                            <textarea name="isi_komentar" id="komentar" cols="30" rows="5"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-sm">Komentar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
            @endif
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('plugins/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '#jawaban'
        });

        tinymce.init({
            selector: '#komentar',
            hight: 300,
        });
    </script>
@endpush