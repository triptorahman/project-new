        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        

                    

                            <form method="post" action="{{route('logout')}}" style="display:inline">
                                @csrf
                                
                                    <button class="nav-link" type="submit">Logout
                                    </button>
                               
                                
                              
                                
                                
                            </form>
                                

                                {{-- <a class="nav-link" href="{{route('logout')}}"><i class="fa fa-power -off"></i>Logout</a> --}}
                        
                    </div>

                </div>
            </div>

        </header><!-- /header -->