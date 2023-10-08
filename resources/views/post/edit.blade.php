@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Edit Post</h2>
            
            <!-- 更新失敗跳出錯誤訊息 -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin:0;">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- 上傳成功後顯示提示訊息 -->
            @if(session('success'))
                <div class="alert alert-success">
                    Updated successfully!
                </div>
            @endif
            
            <!-- 編輯一筆資料 -->
            <form action="{{ route('post.update',[$message->id]) }}" method='post'>
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="title">Title</label>
                                                                                    <!-- 收到post資料並顯示出來 -->
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title',
                        $message->title) }}">
                        <!-- 若是沒過vaild，會重新整理表單，並顯示已經填寫過的值 -->
                </div>                                                              
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea type="text" class="form-control" id="content" name="content" row="5">{{ old('content',$message->content) }}</textarea>
                </div>
                <button type="submit" class="btn btn-outline-secondary mt-4">Update</button>
            </form>

            <form action="{{ route('post.destroy', [$message->id]) }}" method="post" onSubmit="return confirm('Are you sure?')">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-outline-secondary mt-4">Delete This Post</button>
            </form>
        </div>
    </div>
</div>
@endsection

