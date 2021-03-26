<div class="row mx-2 my-2 border rounded">
  <div class="col-12">
      <div class="row bg-light">
          <div class="col-12">
              <div class="row">
                  <div class="col-lg-2 border-right">
                      <a href="{{route('tickets.show', $ticket->ticket_id)}}">#{{$ticket->ticket_id}}</a>
                  </div>
                  <div class="col-lg-9">
                      <div class="row">
                          <div class="col-lg-12">
                              <h4><strong><a href="{{route('tickets.show', $ticket->ticket_id)}}" style="color: black;text-decoration:none;">{!! $ticket->title !!}</a></strong></h4>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-lg-12">
                              @if(strlen($ticket->body) > 200)
                                  {{substr($ticket->body, 0, 200)}}...
                              @else
                                  {{$ticket->body}}
                              @endif
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-1 border-left">
                      <div class="float-right px-2">
                          <i class="fas fa-comment-dots"></i>{{$ticket->ticketBodies->count()}}
                      </div>
                  </div>
              </div>
              <div class="row border-top">
                  <div class="col-lg-4 border-right text-center">
                      @if ($ticket->manager_id !== null)
                          <strong>Assigned to: </strong> {{$ticket->assignee->name}}
                      @else
                          <strong>Assigned to: </strong> TBC
                      @endif
                  </div>
                  <div class="col-lg-4 border-right text-center">
                      <strong>Raised by: </strong> {{$ticket->user->name}}
                  </div>
                  <div class="col-lg-2 border-right text-center">
                      <strong>Issue: </strong>{{$ticket->category->name}}
                  </div>
                  <div class="col-lg-2 text-center" style="background-color: {{$ticket->status->color}}">
                      <strong>Status: </strong><span>{{$ticket->status->name}}</span>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>