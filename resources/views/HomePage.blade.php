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
                <th>comment time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
            <tr>
                <td>
                    {{ $message -> title }}
                        <!-- 編輯文件 -->
                        <!--現在先是未登陸無法修改全部人資料-->
                        @auth
                            @if(Auth::user()->id==$message->userid)
                            <!-- auth可以保證未登入的情況下看不到貼文 -->
                            <a href="{{ route('post.edit', [$message->id])}}">(Edit)</a>
                            @endif
                        @endauth
                </td>
                <td>
                    {{($message -> content)}}
                </td>
                <td>
                    {{ $message->created_at }}
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
    <a href="\post\create" type="button" class="btn btn-outline-secondary">Create Message</a>
</div>

@endsection
