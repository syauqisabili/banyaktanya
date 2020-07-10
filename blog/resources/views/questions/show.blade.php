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
            <div class="d-inline">
                <a class="mr-1 btn btn-primary btn-sm" href="{{ route('pertanyaan.edit', [$item->id]) }}">Edit</a>
                <form class="d-inline-block" action="{{ route('pertanyaan.edit', [$item->id]) }}" method="post">
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </div>
        </div>
    </div>
@endsection