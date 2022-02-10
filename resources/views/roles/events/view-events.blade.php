@extends('layouts.app', ['activePage' => 'events', 'titlePage' => __('View Events')])

@section('content')

    <div class="content">
        <div class="container-fluid">
            @if (session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <head>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
            <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
        </head>
        <body>
        <h5 style="padding-top: 5px;" align="center"><b>EC-RINP EVENT CALENDAR</b></h5>
        <br/>

        <div class="container"  style="height: 900px; width: 1200px;">
            <div id="cal">{!! $calendar->calendar() !!}</div>
            {!! $calendar->script() !!}
        </div>
        </body>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Create new event</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <label class="col-xs-4" for="title">Event title</label>
                            <input type="text" name="title" id="title" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <label class="col-xs-4" for="starts-at">Starts at</label>
                            <input type="text" name="starts_at" id="starts-at" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <label class="col-xs-4" for="ends-at">Ends at</label>
                            <input type="text" name="ends_at" id="ends-at" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-event">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    @push('custom-scripts')
        <script>
            function myFunction() {
                alert(event.title);
            }
            $(document).ready(function() {
                $(function() {
                    $('#calendar-{{$calendar->getId()}}').fullCalendar({
                        selectable: true,
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay'
                        },
                        eventMouseover: function(event, jsEvent, view) {
                            $('.fc-event-inner', this).append('<div id=\"'+event.id+'\" class=\"hover-end\">'+$.fullCalendar.formatDate(event.end, 'h:mmt')+'</div>');
                        },

                        eventMouseout: function(event, jsEvent, view) {
                            $('#'+event.id).remove();
                        }
                    });

                });

            });
            </script>
    @endpush


@endsection
