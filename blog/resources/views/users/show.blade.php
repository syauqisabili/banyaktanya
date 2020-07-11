@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="bg-white">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-dark active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-dark" id="questions-tab" data-toggle="tab" href="#questions" role="tab" aria-controls="questions" aria-selected="false">Questions</a>
                        </li>
                    </ul>
                    <div class="tab-content rounded shadow-sm" id="myTabContent">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="p-4" style="min-height: 200px">
                                <h3>{{ $user->name }}</h3>
                                <p>{{ $user->email }}</p>
                                <p>Reputasi: {{ $reputasi }}</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="questions" role="tabpanel" aria-labelledby="questions-tab">
                            <div class="p-4" style="min-height: 200px">
                                <div class="bg-secondary text-light pl-4">Pertanyaan Anda</div>
                                <ul class="border rounded py-2">
                                    @forelse ($user->questions as $item)
                                        <li><a href="{{ route('pertanyaan.show', [$item->id]) }}">{{ $item->judul }}</a></li>
                                    @empty
                                        <p>Tidak ada</p>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection