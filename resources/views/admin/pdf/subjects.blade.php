
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

@php
    $columns=['ID','Title','Supervisor',
    'Co-supervisor'] ;
@endphp

<style>
    table{
        border-collapse: collapse ;
        min-width:100% ; 
        border: 1px black solid

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

<table  >
    <thead>
        <tr>
        @foreach ($columns as $col)
            <td>{{$col}}</td>
        @endforeach
    </tr>
    </thead>
<tbody >
    @if (empty($subjects))
        <tr style="height: 300px">
            <td colspan="{{count($columns)}}">No Subjects .</td></tr>
    @endif
    @foreach ($subjects as $subject)
        <tr>
                <td>{{$subject->id}}</td>
                <td>{{$subject->title}}</td>
                <td>
                {{$subject->supervisor?->firstname}} {{$subject->supervisor?->lastname}}

                </td>
                <td>
                 {{$subject->coSupervisor?->firstname}} {{$subject->coSupervisor?->lastname}}

                </td>

            
           
        </tr>
    @endforeach

</tbody>
</table>



    
</body>
</html>