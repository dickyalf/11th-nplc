<div>
    <!-- Statistics -->
    <div class="content-heading d-flex justify-content-between align-items-center">
        <span>
            Statistics
        </span>
        <div class="dropdown">
            <button type="button" class="btn btn-sm btn-alt-secondary" id="ecom-dashboard-stats-drop"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span>{{$statistic}}</span>
                <i class="fa fa-angle-down ms-1 opacity-50"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="ecom-dashboard-stats-drop">
                <a class="dropdown-item @if($statistic == 'Today') active @endif" href="javascript:void(0)" wire:click='today'>
                    <i class="fa fa-fw fa-calendar-alt opacity-50 me-1"></i> Today
                </a>
                <a class="dropdown-item @if($statistic == 'This Week') active @endif" href="javascript:void(0)" wire:click='thisWeek'>
                    <i class="fa fa-fw fa-calendar-alt opacity-50 me-1" ></i> This Week
                </a>
                <a class="dropdown-item @if($statistic == 'This Month') active @endif" href="javascript:void(0)" wire:click='thisMonth'>
                    <i class="fa fa-fw fa-calendar-alt opacity-50 me-1"></i> This Month
                </a>
                <a class="dropdown-item @if($statistic == 'This Year') active @endif" href="javascript:void(0)" wire:click='thisYear'>
                    <i class="fa fa-fw fa-calendar-alt opacity-50 me-1"></i> This Year
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item @if($statistic == 'All Time') active @endif" href="javascript:void(0)" wire:click='allTime'>
                    <i class="far fa-fw fa-circle opacity-50 me-1"></i> All Time
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Earnings -->
        <div class="col-md-6 col-xl-3">
            <a class="block block-rounded block-transparent bg-gd-elegance" href="javascript:void(0)">
                <div class="block-content block-content-full block-sticky-options">
                    <div class="block-options">
                        <div class="block-options-item">
                            <i class="fa fa-chart-area text-white-75"></i>
                        </div>
                    </div>
                    <div class="py-3 text-center">
                        <div class="fs-2 fw-bold mb-0 text-white">@rupiah($earning)</div>
                        <div class="fs-sm fw-semibold text-uppercase text-white-75">Earnings</div>
                    </div>
                </div>
            </a>
        </div>
        <!-- END Earnings -->

        <!-- Orders -->
        <div class="col-md-6 col-xl-3">
            <a class="block block-rounded block-transparent bg-gd-dusk" href="be_pages_ecom_orders.html">
                <div class="block-content block-content-full block-sticky-options">
                    <div class="block-options">
                        <div class="block-options-item">
                            <i class="fa fa-archive text-white-75"></i>
                        </div>
                    </div>
                    <div class="py-3 text-center">
                        <div class="fs-2 fw-bold mb-0 text-white">{{$orders}}</div>
                        <div class="fs-sm fw-semibold text-uppercase text-white-75">Orders</div>
                    </div>
                </div>
            </a>
        </div>
        <!-- END Orders -->

        <!-- New Customers -->
        <div class="col-md-6 col-xl-3">
            <a class="block block-rounded block-transparent bg-gd-sea" href="javascript:void(0)">
                <div class="block-content block-content-full block-sticky-options">
                    <div class="block-options">
                        <div class="block-options-item">
                            <i class="fa fa-users text-white-75"></i>
                        </div>
                    </div>
                    <div class="py-3 text-center">
                        <div class="fs-2 fw-bold mb-0 text-white">{{$newUsers}}</div>
                        <div class="fs-sm fw-semibold text-uppercase text-white-75">New Users</div>
                    </div>
                </div>
            </a>
        </div>
        <!-- END New Customers -->

        <!-- Conversion Rate -->
        <div class="col-md-6 col-xl-3">
            <a class="block block-rounded block-transparent bg-gd-aqua" href="javascript:void(0)">
                <div class="block-content block-content-full block-sticky-options">
                    <div class="block-options">
                        <div class="block-options-item">
                            <i class="fa fa-cart-arrow-down text-white-75"></i>
                        </div>
                    </div>
                    <div class="py-3 text-center">
                        <div class="fs-2 fw-bold mb-0 text-white">{{$inShoppingCart}}</div>
                        <div class="fs-sm fw-semibold text-uppercase text-white-75">Item in Cart</div>
                    </div>
                </div>
            </a>
        </div>
        <!-- END Conversion Rate -->
    </div>
    <!-- END Statistics -->
</div>
