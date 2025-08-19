@if ($konsultasi->status === 'proses')
    <div class="chat-box d-flex flex-column" style="height: 500px;">
        <!-- Header -->
        <div class="chat-header border-bottom p-3 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img src="{{ asset('assets/images/user.png') }}" class="rounded-circle me-2" width="40" alt="User">
                <div>
                    <h6 class="mb-0">
                        {{ $konsultasi->laporan
                            ? $konsultasi->laporan->korban->nama_lengkap ?? 'Korban'
                            : $konsultasi->user->name ?? 'User' }}
                    </h6>
                    <small class="text-muted">Sesi Konsultasi</small>
                </div>
            </div>
            <div class="chat-features">
                <div class="d-none d-sm-inline-block">
                    <!-- Tombol Meet Online -->
                    <button class="btn-meet btn btn-sm btn-primary" data-id="{{ $konsultasi->id }}">
                        <i class="la la-video"></i> Mulai Meet
                    </button>
                    <button class="btn btn-sm btn-secondary ms-2 btn-tutup-sesi" data-id="{{ $konsultasi->id }}">
                        Tutup Sesi
                    </button>

                </div>
            </div>

        </div>

        <!-- Body -->
        <div class="chat-body flex-grow-1 p-3 overflow-auto" id="chatBody">
            @forelse($konsultasi->chats as $chat)
                <div class="media mb-3 {{ $chat->pengirim_id == auth()->id() ? 'justify-content-end text-end' : '' }}">


                    {{-- Bubble --}}
                    <div class="media-body {{ $chat->pengirim_id == auth()->id() ? 'reverse' : '' }}">
                        <div
                            class="chat-msg 
                            {{ $chat->pengirim_id == auth()->id() ? 'bg-primary text-white' : 'bg-light' }}">
                            <p class="mb-1">{!! $chat->pesan !!}</p>
                        </div>
                        <small class="chat-time text-muted">
                            {{ \Carbon\Carbon::parse($chat->created_at)->format('H:i') }}
                        </small>
                    </div>

                    @if ($chat->user_id == auth()->id())
                        <div class="media-img ms-2">
                            <img src="{{ asset('assets/images/user.png') }}" class="rounded-circle thumb-sm"
                                width="35" alt="Me">
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-muted text-center">Belum ada pesan.</p>
            @endforelse
        </div>

        <!-- Footer -->
        <div class="chat-footer border-top p-3">
            <form id="chatForm" method="POST" action="{{ route('konselor.konsultasi.send', $konsultasi->id) }}"
                class="d-flex align-items-center gap-2">
                @csrf
                <span class="chat-admin">
                    <img src="{{ asset('assets/images/user.png') }}" alt="user" class="rounded-circle thumb-sm">
                </span>
                <input type="text" name="pesan" class="form-control" placeholder="Ketik pesan..." required>
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
