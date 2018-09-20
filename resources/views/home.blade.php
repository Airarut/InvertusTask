@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

<script>
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev, status) {
    ev.preventDefault();
    console.log(status);
    var data = ev.dataTransfer.getData("text");
    //console.log("update/"+data);
    //window.location.replace("update/"+data);
    $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'update/'+data,
                type: 'PATCH',
                data: {state: status},
                success: function(res) {
                    location.reload();
                }
        });
    //ev.target.appendChild(document.getElementById(data));
}
</script>

<div class="container">
    <div class="row">
        <button type="button" class="btn btn-success col-md-2 ml-3" data-toggle="modal" data-target="#add-modal">Add item!</button>
    </div>
    <div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card mt-2">
                <div class="card-header">Dashboard</div>
                <div class="card-body">

                    <!--@if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!-->
                    <table class="table w-100 table-responsive-md table-borderless">
                        <thead class="thead-dark">
                    <tr>

                        @foreach($data as $value)
                        <th>{{$value->name}}</th>
                        @endforeach
                    </tr>
                </thead>
                        @foreach($items as $item)
                    <tr>
                        @if(($item->state===1) && ($item->userid===Auth::user()->id))
                        <td>
                            <div class="card" draggable="true" id="{{$item->id}}" ondragstart="drag(event)">
                                <div class="card-header">{{$item->name}}<a href="delete/{{$item->id}}"><i class="far fa-trash-alt float-right"></i></a></div>
                                <div class="card-body">{{$item->description}}</div>
                            </div>
                        </td>
                        @else
                        <td ondragover="allowDrop(event)" ondrop="drop(event, 1)"></td>
                        @endif
                        
                        @if($item->state===2 && $item->userid===Auth::user()->id)
                        <td>
                            <div class="card" draggable="true" id="{{$item->id}}" ondragstart="drag(event)">
                                <div class="card-header">{{$item->name}}<a href="delete/{{$item->id}}"><i class="far fa-trash-alt float-right"></i></a></div>
                                <div class="card-body">{{$item->description}}</div>
                            </div>
                        </td>
                        @else
                        <td ondragover="allowDrop(event)" ondrop="drop(event, 2)"></td>
                        @endif
                        @if($item->state===3 && $item->userid===Auth::user()->id)
                        <td>
                            <div class="card" draggable="true" id="{{$item->id}}" ondragstart="drag(event)">
                                <div class="card-header">{{$item->name}}<a href="delete/{{$item->id}}"><i class="far fa-trash-alt float-right"></i></a></div>
                                <div class="card-body">{{$item->description}}</div>
                            </div>
                        </td>
                        @else
                        <td ondragover="allowDrop(event)" ondrop="drop(event, 3)"></td>
                        @endif
                        @if(($item->state===4) && ($item->userid===Auth::user()->id))
                        <td>
                            <div class="card" draggable="true" id="{{$item->id}}" ondragstart="drag(event)">
                                <div class="card-header">{{$item->name}}<a href="delete/{{$item->id}}"><i class="far fa-trash-alt float-right"></i></a></div>
                                <div class="card-body">{{$item->description}}</div>
                            </div>
                        </td>
                        @else
                        <td ondragover="allowDrop(event)" ondrop="drop(event, 4)"></td>
                        @endif
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" align="center"><b>Add task</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" action="/insert" method="post">
            {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group">
              <label for="task_name">Task Name</label> 
              <input type="text" class="form-control" id="task_name" name="task_name" placeholder="Name" >
            </div>
            <div class="form-group">
              <label for="task_description">Task Decription</label> 
              <textarea type="text" class="form-control" id="task_description" name="task_description" placeholder="Description">
              </textarea>
            </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add new task</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
