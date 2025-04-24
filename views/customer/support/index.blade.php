@extends('customer.layouts.app')

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="text-blue h4">Technical Support Messages</h4>
                </div>
            </div>
        </div>

        <div class="row px-3">

            <!-- Send Message Form -->
            <div class="col-md-4">
                <div class="card-box p-4">
                    <h5>Send New Message</h5>
                    <form method="POST" action="{{ route('customer.support.send') }}">
                        @csrf
                        <div class="form-group">
                            <label>Write your message</label>
                            <textarea class="form-control" name="text" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Send Message</button>
                    </form>
                </div>
            </div>
            <!-- Message History -->
            <div class="col-md-8">
                <div class="card-box p-4">
                    <h5 class="mb-3">Message History</h5>
                    <table class="data-table table hover nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
{{--                            <th>From</th>--}}
{{--                            <th>To</th>--}}
                            <th>Message</th>
                            <th>Reply</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($messages as $index => $msg)
                            <tr>
                                <td>{{ $index + 1 }}</td>
{{--                                <td>{{ $msg->sender->accountType === 'admin' ? 'Customer Support' : $msg->sender->accountName }}</td>--}}
{{--                                <td>{{ $msg->recipient->accountType === 'admin' ? 'Customer Support' : $msg->recipient->accountName }}</td>--}}
                                <td>{{ \Illuminate\Support\Str::limit($msg->text, 50) }}</td>
                                <td>
                                    @if($msg->reply)
                                        <span class="badge badge-success">Yes</span>
                                    @else
                                        <span class="badge badge-secondary">No</span>
                                    @endif
                                </td>
                                <td>
                                    @if($msg->reply)
                                        <a href="#" class="btn btn-sm btn-outline-info" onclick="viewReply('{{ $msg->reply }}')">
                                            View Reply
                                        </a>
                                    @endif
{{--                                    <a href="#" class="btn btn-sm btn-outline-primary" onclick="viewConversation({{ $msg->messageNumber }})">--}}
{{--                                        View Conversation--}}
{{--                                    </a>--}}
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted">No messages yet</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Modal for Reply -->
        <div class="modal fade" id="replyModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Support Reply</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="replyContent"></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Conversation -->
        <div class="modal fade" id="conversationModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Full Conversation</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="conversationBody">
                        <!-- Messages will be loaded via JS -->
                        <p class="text-muted text-center">Loading...</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
@push('js')

    <script>
        function viewReply(content) {
            document.getElementById('replyContent').innerText = content;
            $('#replyModal').modal('show');
        }

        function viewConversation(messageID) {
            fetch(`support/conversation/${messageID}`)
                .then(response => response.json())
                .then(messages => {
                    const container = document.getElementById('conversationBody');
                    container.innerHTML = '';
                    messages.forEach(msg => {
                        const isSupport = msg.sender.accountType === 'admin';
                        container.innerHTML += `
                        <div class="mb-2 ${isSupport ? 'text-right' : 'text-left'}">
                            <div class="d-inline-block p-2 rounded" style="background: ${isSupport ? '#e0f7fa' : '#f1f1f1'}">
                                <strong>${isSupport ? 'Customer Support' : msg.sender.accountName}</strong><br>
                                ${msg.text}
                            </div>
                        </div>
                    `;
                    });
                    $('#conversationModal').modal('show');
                });
        }
    </script>
@endpush
