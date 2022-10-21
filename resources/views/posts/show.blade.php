@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{-- <div class="card-header">{{ __('View Post') }}</div> --}}

                <div class="card-body">
                    
                    {{-- {{$post['title']}} --}}

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <h2 class="text-3xl font-bold underline">{{$post->title??null}}</h2>

                    <p>Published At: {{date('Y-m-d', strtotime($post->published_at))}}</p>
                    <br>
                    <div>
                        {{$post->body??null}}
                    </div>
                </div>
                <table class="table table-bordered">                    
                    <tbody>                        
                        <tr>                           
                            <td>
                            <a href="{{$post->id}}/edit" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                            <form action="{{$post->id}}" method="post" class="d-inline">
                                {{ csrf_field() }}
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                            </td>
                        </tr>                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection