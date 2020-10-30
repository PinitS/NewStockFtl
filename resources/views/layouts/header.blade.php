<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                </div>
                <ul class="navbar-nav header-right">
                    <li class="nav-item dropdown notification_dropdown">
                        @if(session()->has('branch'))
                            <span class="text-danger">{{ session()->get('branch')[0]['name'] }}</span>
                            <button type="button" class="btn-sm ml-3 btn btn-outline-danger pnt-btn-forget-session">
                                Leave
                            </button>
                        @endif

                        @if(session()->has('customer'))
                            <span class="text-warning">{{ session()->get('customer')[0]['name'] }}</span>
                            <button type="button"
                                    class="btn-sm ml-3 btn btn-outline-warning pnt-btn-forget-session-customer">Leave
                            </button>
                        @endif
                    </li>
                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                            <div class="header-info">
                                <strong>{{ Auth::user()->name }}</strong>
                                <small>
                                    @if(Auth::user()->status == 1)
                                        Admin
                                    @else
                                        Member
                                    @endif
                                </small>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item ai-icon pnt-btn-profile">
                                <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18"
                                     height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span class="ml-2">Profile </span>
                            </a>
                            <input id="pnt-logout-token" type="hidden" runat="server" value="{{ csrf_token() }}"/>
                            <button type="button" class="dropdown-item ai-icon pnt-btn-logout">
                                <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18"
                                     height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                <span class="ml-2">Logout </span>
                            </button>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
