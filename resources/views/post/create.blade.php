@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Create Post</h2>
            
            <!-- 更新失敗跳出錯誤訊息 -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- 創建一筆新資料 -->
            <form action="{{ route('post.store') }}" method='post'>
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea type="text" class="form-control" id="content" name="content" row="5"></textarea>
                </div>
                <button type="submit" class="btn btn-outline-secondary mt-4">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection

