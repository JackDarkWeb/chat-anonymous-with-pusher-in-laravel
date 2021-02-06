@extends('layouts.app', ['title' => 'Anonymous Chat'])

@section('content')

    <div class="row">
        <div class="col-md-8 col-lg-9 bg-light" style="position:absolute; left: 0px;">
            <div class="row">
                <div class="form-group w-100">
                    <div class="panel panel-primary">
                        <h4 class="panel-heading bg-light p-3 font-weight-bold shadow">
                            <i class="fa fa-comments" aria-hidden="true"></i> Anonymous Chat
                        </h4>

                        <div class="panel-body body-panel bg-white px-4 py-5">

                            <ul class="chat message my-5">

                                @foreach($messages as $message)
                                    <li class="p-2 mb-2 rounded">
                                        <span class="d-block font-weight-bold">{{ $message->user_name }}</span>
                                        <span class="d-block">{{ $message->body }}</span>
                                        <span class="d-block small">{{ $message->created_at }}</span>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>

                    @include('forms')

                </div>
            </div>
        </div>

        @include('users')
    </div>





@endsection

@section('scripts')

    <script type="module">

        import Forms from "{{ asset('js/Forms.js') }}"

        $(function () {

            let request = new Object();

            const $doc  = $(document),
                  $wind = $(window);

            Forms.scrollToBottomFunc();

            let pusher = new Pusher('e851073613e63c251b47', {
                cluster: 'eu'
            });

            let channel = pusher.subscribe('my-channel');

            channel.bind('my-event', function(data) {

                Forms.contentMessages(data);
            });


            Forms.submitWithEnter('message-form', '#message');


            $doc.on('submit', '#message-form', function (event) {

                event.preventDefault();

                if (Forms.getValue(this, '#message')) {

                    request.body = Forms.getValue(this, '#message');

                    Forms.requestAjax('POST', "{{ route('message.send') }}", function () {

                        Forms.setValue('#message-form', '#message', ' ');

                        Forms.scrollToBottomFunc()

                    }, request);
                }
            });




        });
    </script>

@endsection
