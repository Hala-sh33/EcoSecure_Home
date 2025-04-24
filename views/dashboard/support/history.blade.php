@extends('dashboard.layouts.app')

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Support Messages</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.support.index') }}">Support Messages</a></li>
                            <li class="breadcrumb-item active" aria-current="page">History</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="card-box p-4">
            <table class="data-table table  hover nowrap">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Sender</th>
                    <th>Message</th>
                    <th>Reply</th>
                </tr>
                </thead>
                <tbody>
                @forelse($messages as $index => $msg)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $msg->sender->accountName }} ({{ $msg->sender->email }})</td>
                        <td>{{ $msg->text }}</td>
                        <td>
                            @if($msg->reply)
                                <span class="badge badge-success">✔ {{ $msg->reply }}</span>
                            @else
                                <span class="badge badge-warning">No Reply</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No messages found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
