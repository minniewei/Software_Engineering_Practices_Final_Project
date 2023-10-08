@extends('layouts.app')
@section('content')
<div class="container mt-3">
    <h2>Message Board!!</h2>
    <p>You can leave some messages you like here</p>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>More Details</th>
                <th>Comment Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
            <tr>
                <td>
                    {{ strlen($message->title) > 10 ? substr($message->title, 0, 10) . '...' : $message->title }}
                </td>
                
                <td>
                    {{ strlen($message->content) > 10 ? substr($message->content, 0, 10) . '...' : $message->content }}
                </td>
                <td>
                    <button type="button" class="btn btn-outline-secondary" onclick="showModal({{ $message->id }})">
                        Details
                    </button>
                </td>
                <td>
                    {{ $message->created_at }}
                </td>
                <td>
                    <!-- 加入編輯按鈕 -->
                    @auth
                    @if(Auth::user()->id==$message->userid)
                    <!-- auth可以保證未登入的情況下看不到貼文 -->
                    <a href="{{ route('post.edit', [$message->id]) }}">Edit</a>
                    @endif
                    @endauth
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="\post\create" type="button" class="btn btn-outline-secondary">Create Message</a>
</div>

<!-- JavaScript 代码来显示模态框 -->
<script>
    function showModal(messageId) {
        var modal = document.getElementById('myModal' + messageId);
        modal.style.display = 'block';
    }
</script>

<!-- 模态框部分不需要任何 Bootstrap 代码 -->
@foreach($messages as $message)
    <div id="myModal{{ $message->id }}" class="modal" style="display: none;">
        <div class="modal-dialog" style="display: flex; justify-content: center; align-items: center; height: 100vh;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Message</h4>
                    <button type="button" class="close btn btn-outline-secondary" onclick="closeModal({{ $message->id }})">&times;</button>
                </div>
                <div class="modal-body" style="overflow-y: auto; word-wrap: break-word;">
                    <p><strong>Title:</strong> {{ $message->title }}</p>
                    <p><strong>Content:</strong></p>
                    <p>{{ $message->content }}</p>
                    <p><strong>Time:</strong> {{ $message->created_at }}</p>
                </div>
            </div>
        </div>
    </div>
@endforeach


<script>
    function showModal(messageId) {
        var modal = document.getElementById('myModal' + messageId);
        modal.style.display = 'block';

        // 添加遮罩效果
        var overlay = document.createElement('div');
        overlay.className = 'modal-overlay';
        document.body.appendChild(overlay);
    }

    function closeModal(messageId) {
        var modal = document.getElementById('myModal' + messageId);
        modal.style.display = 'none';

        // 移除遮罩效果
        var overlay = document.querySelector('.modal-overlay');
        if (overlay) {
            overlay.remove();
        }
    }


    window.addEventListener('click', function(event) {
        var modals = document.querySelectorAll('.modal');
        for (var i = 0; i < modals.length; i++) {
            var modal = modals[i];
            if (event.target === modal) {
                closeModal(modal.id.replace('myModal', ''));
            }
        }
    });
</script>

@endsection
