<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            @if(!session()->has('customer') && !session()->has('branch') && !session()->has('dealer'))
                {{--                <li class="nav-label">FARM THAILAND</li>--}}
                <li><a href="{{ url('report/dashBoard') }}" aria-expanded="false">
                        <i class="fa fa-line-chart"></i>
                        <span class="nav-text">@lang('DashBoard')</span>
                    </a>
                </li>
                <p class="pnt-side-border"></p>
            @endif

            @if(!session()->has('dealer') && !session()->has('customer'))
                {{--                <li class="nav-label ">STOCK</li>--}}
                @if(!session()->has('branch'))
                    <li><a href="{{ url('selectBranch') }}" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path
                                        d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z"
                                        fill="#000000"></path>
                                    <path
                                        d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z"
                                        fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                            <span class="nav-text">@lang('Stock')</span>
                        </a>
                    </li>
                    <p class="pnt-side-border"></p>
                @else
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path
                                        d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z"
                                        fill="#000000"></path>
                                    <path
                                        d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z"
                                        fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                            <span class="nav-text">@lang('Stock')</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('stock/parts/') }}">@lang('Parts')</a></li>
                            <li><a href="{{ url('stock/categories/') }}">@lang('Category')</a></li>
                        <!-- <li><a href="{{ url('manage/groupParts/') }}">@lang('Group Parts')</a></li> -->
                        </ul>
                    </li>
                @endif
            @endif

            @if(!session()->has('dealer') && !session()->has('branch'))

                {{--                <li class="nav-label">Customer Product</li>--}}
                @if(!session()->has('customer'))

                    <li><a href="{{ url('selectCustomer') }}" aria-expanded="false">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="nav-text">@lang('Customer Product')</span>
                        </a>
                    </li>
                    <p class="pnt-side-border"></p>
                @else
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="nav-text">@lang('Customer Product')</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('customer/') }}">@lang('Product List')</a></li>
                        </ul>
                    </li>
                @endif
            @endif

            @if(!session()->has('branch') && !session()->has('customer'))
                {{--                <li class="nav-label">Dealer</li>--}}
                @if(!session()->has('dealer'))
                    <li><a href="{{ url('selectDealer') }}" aria-expanded="false">
                            <i class="fa fa-user"></i>
                            <span class="nav-text">@lang('Dealer')</span>
                        </a>
                    </li>
                    <p class="pnt-side-border"></p>
                @else
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-user"></i>
                            <span class="nav-text">@lang('Dealer')</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('dealer/') }}">@lang('Dealer Product')</a></li>
                            <li><a href="{{ url('dealer/dealerCustomer/') }}">@lang('Dealer Customer')</a></li>
                        </ul>
                    </li>
                @endif
            @endif


            @if(!session()->has('customer') && !session()->has('branch') && !session()->has('dealer'))
                {{--                <li class="nav-label">Product</li>--}}
                <li><a href="{{ url('product_location/product/') }}" aria-expanded="false">
                        <i class="fa fa-archive"></i>
                        <span class="nav-text">@lang('Product')</span>
                    </a>
                </li>
                </li>
                <p class="pnt-side-border"></p>

                @if (Auth::user()->status == 1)
                    {{--                    <li class="nav-label">Manage</li>--}}
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-cog"></i>
                            <span class="nav-text">@lang('Manage')</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('manage/branches/') }}">@lang('Branch')</a></li>
                            <li><a href="{{ url('manage/users/') }}">@lang('User')</a></li>
                            <li><a href="{{ url('manage/model/') }}">@lang('Model')</a></li>
                            <li><a href="{{ url('manage/location/') }}">@lang('Customer')</a></li>
                            <li><a href="{{ url('manage/dealer/') }}">@lang('Dealer')</a></li>
                            <li><a href="{{ url('manage/groupParts/') }}">@lang('Group Parts')</a></li>
                            <li><a href="{{ url('manage/unitParts/') }}">@lang('Unit')</a></li>

                        </ul>
                    </li>
                    <p class="pnt-side-border"></p>

                    {{--                <li class="nav-label">Report</li>--}}
                    <li><a href="{{ url('report/calculator') }}" aria-expanded="false">
                            <i class="fa fa-tv"></i>
                            <span class="nav-text">@lang('Calculator')</span>
                        </a>
                    </li>
                    <p class="pnt-side-border"></p>
                @endif

{{--                --}}{{--                <li class="nav-label">Report</li>--}}
{{--                <li><a href="{{ url('report/calculator') }}" aria-expanded="false">--}}
{{--                        <i class="fa fa-tv"></i>--}}
{{--                        <span class="nav-text">@lang('Calculator')</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <p class="pnt-side-border"></p>--}}

                <li><a href="{{ url('report/pointerLocation/') }}" aria-expanded="false">
                        <i class="fa fa-flag"></i>
                        <span class="nav-text">@lang('Location Product')</span>
                    </a>
                </li>
                <p class="pnt-side-border"></p>

                {{--                <li class="nav-label">Dealer Sell</li>--}}
                <li><a href="{{ url('dealerSell/') }}" aria-expanded="false">
                        <i class="fa fa-truck"></i>
                        <span class="nav-text">@lang('Dealer Sell')</span>
                    </a>
                </li>
                </li>


            @endif
        </ul>
    </div>
</div>
