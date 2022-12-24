<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    
     @include('layouts.top') {{-- css --}}
     
  

</head>
<body>


        <!-- Left Panel -->

    @include('layouts.navigation')

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
@include('layouts.header')
        <!-- Header-->

@yield('content') 
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

@include('layouts.bottom')
</body>
</html>
