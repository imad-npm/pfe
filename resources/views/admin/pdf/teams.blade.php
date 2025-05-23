
<style>
  
    td,th{
        padding: 5px      ;
          border: 1px solid black ;

    }
    thead{
        background-color: rgb(238, 238, 210)
    }
    table{
        border-collapse: collapse ;
        min-width:100% ; 
       
    }
   
    .line-clamp{
        line-clamp: 3 ;

    }
  
</style>

@php
    $columns=['ID','Student 1','Student 2',"Average" ,
    'Assigned Subject','Speciality']
@endphp



<table>
    <thead>
        <tr>
        @foreach ($columns as $col)
            <td>{{$col}}</td>
        @endforeach
    </tr>
    </thead>
<tbody>
    
    @if (empty($teams))
        <tr style="height: 300px">
            <td colspan="{{count($columns)}}">No Teams .</td></tr>
    @endif
    @foreach ($teams as $team)
        <tr>
                <td>{{$team->id}}</td>
                <td>
                {{$team->student1?->fullName}}

                </td>
                <td>
                 {{$team->student2?->fullName}}

                </td>
                <td>
                    {{$team->max_average}}

                </td>

                <td>{{$team->assignedSubject?->title}}</td>

                
                <td>
                  <span class="me-2">{{$team->speciality?->abbreviation}}</span>  
                </td>
          
           
        </tr>
    @endforeach

</tbody>
</table>



