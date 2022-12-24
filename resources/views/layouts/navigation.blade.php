    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    
                    <li class="active">
                        <a href=""> <i class="menu-icon fa fa-cubes"></i>Dashboard </a>
                    </li>
                    
                   
                    
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Post</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-list-ul"></i><a href="{{route('posts.create')}}">Create Post</a></li>
                            <li><i class="fa fa-list-ul"></i><a href="{{route('posts.index')}}">Post List</a></li>
                           
                        </ul>
                    </li>

                    
                  

                  
                    
                   
                   
                    
                    
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->