@extends('layout.app')
@section('title', 'Room Konsultasi')
@section('content')
    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card h-100 mb-4">
                    @if ($konsultasi->status === 'proses')
                        <div class="chat-box d-flex flex-column" style="height: 500px;">
                            <!-- Header -->
                            <div class="chat-header border-bottom p-3 d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('img/ic_doc.png') }}" class="rounded-circle me-2" width="40"
                                        alt="Konselor">
                                    <div>
                                        <h6 class="mb-0">{{ $konsultasi->konselor->name }}</h6>
                                        <small class="text-muted">Konselor Anda</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Body -->
                            <div class="chat-body flex-grow-1 p-3 overflow-auto" id="chatBody">
                                @forelse($konsultasi->chats as $chat)
                                    <div
                                        class="media mb-3 {{ $chat->pengirim_id == auth()->id() ? 'justify-content-end text-end' : '' }}">
                                        {{-- Bubble --}}
                                        <div class="media-body {{ $chat->pengirim_id == auth()->id() ? 'reverse' : '' }}">
                                            <div
                                                class="chat-msg 
                                                {{ $chat->pengirim_id == auth()->id() ? 'bg-primary text-white' : 'bg-light' }}">
                                                <p class="mb-1">{{ $chat->pesan }}</p>
                                            </div>
                                            <small class="chat-time text-muted">
                                                {{ \Carbon\Carbon::parse($chat->created_at)->format('H:i') }}
                                            </small>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted text-center">Belum ada pesan.</p>
                                @endforelse
                            </div>

                            <!-- Footer -->
                            <div class="chat-footer border-top p-3">
                                <form id="chatForm" method="POST" action="{{ route('konsultasi.send', $konsultasi->id) }}"
                                    class="d-flex align-items-center gap-2">
                                    @csrf
                                    <input type="text" name="pesan" class="form-control" placeholder="Ketik pesan..."
                                        required>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-paper-plane"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="p-5 text-center text-muted">
                            Sesi konsultasi sudah <strong>selesai</strong>.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .chat-msg {
            display: inline-block;
            padding: 10px 14px;
            border-radius: 16px;
            max-width: 70%;
            word-wrap: break-word;
        }

        .chat-body {
            background: #f9f9f9;
        }

        .chat-time {
            font-size: 11px;
            display: block;
            margin-top: 2px;
        }

        .media-body.reverse {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }
    </style>
@endpush
