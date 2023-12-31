     <ul class="list-group rounded-0 my-4 border-0" wire:sortable="updateTaskOrder">
         <div type="button" class="list-group-item list-group-item-action active bg-dark text-light border-0">
             <div class="d-flex justify-content-between align-items-center align-self-baseline">
                 <span class="col-sm-3 mr-4">Task</span>
                 <span>Priority</span>
                 <span></span>
             </div>
         </div>

         @forelse ($tasks as $task)
             <li class="list-group-item border-0 m-0 py-2" wire:sortable.item="{{ $task->id }}" draggable="true"
                 wire:key="{{ $task->id }}">
                 <div class="d-flex justify-content-between align-items-center align-self-baseline">

                     <p class="col-sm-4"><i class="icon ion-md-resize"> </i> {{ $task->name }}</p>

                     <span class="text-info font-bold">
                         #{{ $task->priority }}
                     </span>
                     <div class="d-flex justify-content-around">
                         @can('update', $task)
                             <a href="{{ route('tasks.edit', [$task->project_id, $task]) }}">
                                 <button type="button" class="btn btn-light mx-1">
                                     <i class="icon ion-md-create"></i>
                                 </button>
                             </a>
                         @endcan
                         @can('delete', $task)
                             <form action="{{ route('tasks.destroy', [$task->project_id, $task]) }}" method="POST"
                                 onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                 @csrf @method('DELETE')
                                 <button type="submit" class="btn btn-light text-danger">
                                     <i class="icon ion-md-trash"></i>
                                 </button>
                             </form>
                         @endcan
                     </div>
                 </div>
             </li>

         @empty
             <p>No tasks in this projects</p>
         @endforelse
     </ul>
