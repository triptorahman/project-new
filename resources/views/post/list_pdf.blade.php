<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Post List</title>
    

    
</head>
<body>

<div style="text-align: center; margin-bottom: 30px">
    
    
   <h1>Post List</h1>

    

   
</div>

<table style="border-collapse: collapse; border-spacing: 0; width: 100%;text-align: center;vertical-align:middle;"
       border="1">
    <thead>
    <tr>
        
        <th>SL</th>
        <th>Title</th>
        <th>Short Description</th>
        <th>Status</th>
        
        
    </tr>
    </thead>
    <tbody id="tablecontents">
    
        @foreach ($posts as $row)
        <tr>
            <td>{{$loop->iteration}}</td>
              <td>{{$row->title}}</td>
              <td>{{$row->short_description}}</td>
              
              
              <td>
                @if($row->status==1)
                    Active

                
                @else
                    Inactive

                @endif

              </td>

            
           
       </tr>
        @endforeach
  
    </tbody>
</table>
</body>
</html>

<?php //exit; ?>