<div class="row mx-2 my-2 border rounded">
  <div class="col-12">
      <div class="row bg-light">
          <div class="col-12">
              <div class="row">
                  <div class="col-lg-3 border-right">
                      <a href="{{route('tickets.show', $ticket->ticket_id)}}">#{{$ticket->ticket_id}}</a>
                  </div>
                  <div class="col-lg-9">
                      <div class="row">
                          <div class="col-lg-12">
                              <h4><strong><a href="{{route('tickets.show', $ticket->ticket_id)}}" style="color: black;text-decoration:none;">{!! $ticket->title !!}</a></strong></h4>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row border-top">
                  <div class="col-lg-5 border-right text-center">
                      @if ($ticket->manager_id !== null)
                          <strong>Staff member handling ticket: </strong> {{$ticket->assignee->username}}
                      @else
                          <strong>Staff member handling ticket: </strong> TBC
                      @endif
                  </div>
                  <div class="col-lg-4 border-right text-center">
                      <strong>Issue: </strong>{{$ticket->category->name}}
                  </div>
                  <div class="col-lg-3 text-center" style="background-color: {{$ticket->status->color}}">
                      <strong>Status: </strong><span>{{$ticket->status->name}}</span>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>