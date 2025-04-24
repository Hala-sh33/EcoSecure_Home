@extends('dashboard.layouts.app')

@section('content')
    <div class="min-height-200px">
        <div class="page-header d-flex justify-content-around">
            <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Support Messages</h4>
            </div>
            </div>

            <div class="col-md-6 col-sm-12 text-right">
                <a class="btn btn-primary" href="{{ route('admin.support.history') }}">
                    Messages History <i class="dw dw-list"></i>
                </a>
            </div>
        </div>


        <div class="card-box p-4">
            @foreach($messages as $message)
                <div class="border p-3 mb-3">
                    <h6><strong>From:</strong> {{ $message->sender->accountName }} ({{ $message->sender->email }})</h6>
                    <p><strong>Message:</strong> {{ $message->text }}</p>

                    <form method="POST" action="{{ route('admin.support.reply', $message->messageNumber) }}">
                        @csrf
                        <div class="form-group">
                            <label>Reply</label>
                            <textarea name="reply" class="form-control" rows="3" required></textarea>
                        </div>
                        <button class="btn btn-primary btn-sm mt-2">Send Reply</button>
                    </form>
                </div>
            @endforeach

            @if($messages->isEmpty())
                <p class="text-muted text-center">No pending messages to reply.</p>
            @endif
        </div>
    </div>
@endsection
