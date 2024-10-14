<nav class="bar bar-tab">
    <a class="tab-item {{ Request::segment(1) === null ? 'active' : '' }}" href="{{ route('homepage') }}"
        data-ignore="push">
        <span class="icon icon-home"></span>
        <span class="tab-label">Home</span>
    </a>
    <a class="tab-item {{ Request::segment(1) === 'history' ? 'active' : '' }}" href="{{ route('history') }}"
        data-ignore="push">
        <span class="icon icon-refresh"></span>
        <span class="tab-label">Riwayat</span>
    </a>
    {{-- <a class="tab-item" href="#">
        <span class="icon icon-person"></span>
        <span class="tab-label">Profil</span>
    </a> --}}
    <a class="tab-item" href="javascript:void(0)" onclick="document.getElementById('form-logout').submit()">
        <span class="icon icon-download"></span>
        <span class="tab-label">Keluar</span>
    </a>
</nav>
