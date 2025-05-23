<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <style>
        table{
            border-collapse: collapse ;
            min-width:100% ; 
    
        }
        td,th{
            padding: 5px      ;
              border: 1px solid black ;
    
        }
        thead{
            background-color: rgb(238, 238, 210)
        }
        .line-clamp{
            line-clamp: 3 ;
    
        }
      
    </style>
    
    @php
        $columns=['ID','First Name','Last Name','Email','Rank','Type','Added by',
        'Institution'] ;
    @endphp
    <table  >
        <thead>
            <tr>
            @foreach ($columns as $col)
                <td>{{$col}}</td>
            @endforeach
        </tr>
        </thead>
    <tbody>
        @if (empty($teachers))
        <tr style="height: 300px">
            <td colspan="{{count($columns)}}">No Teachers .</td></tr>
    @endif
    @foreach ($teachers as $teacher)
        <tr>
                <td>{{$teacher->id}}</td>
                <td>{{$teacher->firstname}}</td>
                <td>{{$teacher->lastname}}</td>
                <td>{{$teacher->email}}</td>
                <td>{{$teacher->rank}}</td>
                <td>{{$teacher->type}}</td>

                <td>
                    {{
                        $teacher->addedBy?->firstname .' '. $teacher->addedBy?->lastname
                        }}
                </td>
                <td>{{$teacher->institution}}</td>

    
        </tr>
    @endforeach

</table>



</body>
</html>