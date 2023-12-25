<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('/') }}">{{ $setting->site_tile }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('/') }}">{{ substr($setting->site_tile,0,2) }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->is('/') || request()->is('home') ? 'active' : '' }}"><a class="nav-link"
                                                                                             href="{{ route('home') }}"><i
                        class="fas fa-fire"></i> <span>Dashboard</span></a></li>

            @if (auth()->user()->role_id == 1)
                <li class="menu-header">Pharmacist</li>
                <li class="{{ request()->is('users') || request()->is('users/*') ? 'active' : '' }}"><a class="nav-link"
                                                                                                        href="{{ route('users.index') }}"><i class="fas fa-fire"></i> <span>Pharmacist</span></a></li>
            @endif
            <li class="menu-header">Customers</li>
            <li class="dropdown {{ request()->is('contacts') || request()->is('contacts/*') || request()->is('suppliers') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-id-badge"></i> <span>Recipients</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->is('contacts/create') ? 'active' : '' }}"><a
                            href="{{ route('contacts.create') }}">Add Contact</a></li>
                    <li class="{{ request()->is('contacts') ? 'active' : '' }}"><a href="{{ route('contacts.index') }}">Customers</a>
                    </li>
                    <li class="{{ request()->is('suppliers') ? 'active' : '' }}"><a
                            href="{{ route('supplier.index') }}">Suppliers</a></li>
                </ul>
            </li>
            @if (auth()->user()->role_id == 1)
                <li class="menu-header">Accounts</li>
                <li class="dropdown {{ request()->is('transactions') || request()->is('income') || request()->is('expense') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-invoice-dollar"></i>
                        <span>Accounts</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ request()->is('income') ? 'active' : '' }}"><a href="{{ route('income.index') }}">Income</a>
                        </li>
                        <li class="{{ request()->is('expense') ? 'active' : '' }}"><a
                                href="{{ route('expense.index') }}">Expense</a></li>
                        <li class="{{ request()->is('transactions') ? 'active' : '' }}"><a
                                href="{{ route('transactions.index') }}">All Transactions</a></li>
                    </ul>
                </li>
            @endif

            <li class="menu-header">Medicines</li>
            <li class="dropdown {{ request()->is('categories') || request()->is('categories/*') || request()->is('units') || request()->is('units/*') || request()->is('types') || request()->is('types/*')
                                    || request()->is('medicines') || request()->is('medicines/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-pills"></i> <span>Medicine</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->is('categories') || request()->is('categories/*') ? 'active' : '' }}">
                        <a href="{{ route('categories.index') }}">Category</a></li>
                    <li class="{{ request()->is('units') || request()->is('units/*') ? 'active' : '' }}">
                        <a href="{{ route('units.index') }}">Unit</a></li>
                    <li class="{{ request()->is('types') || request()->is('types/*') ? 'active' : '' }}">
                        <a href="{{ route('types.index') }}">Type</a></li>
                    <li class="{{ request()->is('medicines') || request()->is('medicines/*') ? 'active' : '' }}">
                        <a href="{{ route('medicines.index') }}">Medicine</a></li>
                </ul>
            </li>
            <li class="menu-header">Purchase</li>
            <li class="{{ request()->is('purchase') || request()->is('purchase/*') ? 'active' : '' }}"><a
                    class="nav-link" href="{{ route('purchase.index') }}"><i class="fas fa-fire"></i>
                    <span>Purchase</span></a></li>
            <li class="menu-header">POS</li>
            <li class="dropdown {{ request()->is('pos') || request()->is('pos/draft/list') || request()->is('pos/create') || request()->is('pos/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-invoice-dollar"></i>
                    <span>POS</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->is('pos') || request()->is('pos/*') || request()->is('pos/draft/list') ? 'active' : '' }}">
                        <a href="{{ route('pos.index') }}">POS Sales</a></li>
                    <li class="{{ request()->is('pos/create') ? 'active' : '' }}"><a href="{{ route('pos.create') }}">POS</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Report</li>
            <li class="dropdown {{ request()->is('stock') || request()->is('stock/batch-wise') || request()->is('pos/report') || request()->is('report/purchase') || request()->is('report/invoice') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fab fa-linode"></i> <span>Report</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->is('stock') ? 'active' : '' }}"><a href="{{ route('stock') }}">Stock</a>
                    </li>
                    <li class="{{ request()->is('stock/batch-wise') ? 'active' : '' }}"><a
                            href="{{ route('stock.batch.wise') }}">Stock (Batch Wise)</a></li>
                    <li class="{{ request()->is('report/purchase') ? 'active' : '' }}"><a
                            href="{{ route('purchase.report') }}">Purchase</a></li>
                    <li class="{{ request()->is('report/invoice') ? 'active' : '' }}"><a
                            href="{{ route('invoice.report') }}">Invoice</a></li>
                </ul>
            </li>

            @if (auth()->user()->role_id == 1)
                <li class="menu-header">Setting</li>
                <li class="{{ request()->is('setting') ? 'active' : '' }}"><a class="nav-link"
                                                                              href="{{ route('setting.index') }}"><i
                            class="fas fa-fire"></i> <span>Setting</span></a></li>
            @endif
        </ul>
    </aside>
</div>
