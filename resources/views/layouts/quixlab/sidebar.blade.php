<!--**********************************
    Sidebar start
***********************************-->
<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{ route('dashboard') }}" aria-expanded="false">
                    <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-label">Master</li>
            <li>
                <a href="{{ route('rates.index') }}" aria-expanded="false">
                    <i class="icon-pin menu-icon"></i><span class="nav-text">Tarif</span>
                </a>
            </li>
            <li>
                <a href="{{ route('customers.index') }}" aria-expanded="false">
                    <i class="icon-people menu-icon"></i><span class="nav-text">Pelanggan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('meters.index') }}" aria-expanded="false">
                    <i class="icon-calculator menu-icon"></i><span class="nav-text">Meteran</span>
                </a>
            </li>
            <li class="nav-label">Transactions</li>
            <li>
                <a href="{{ route('bills.index') }}" aria-expanded="false">
                    <i class="icon-notebook menu-icon"></i><span class="nav-text">Tagihan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('rates.index') }}" aria-expanded="false">
                    <i class="icon-wallet menu-icon"></i><span class="nav-text">Pembayaran</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->
