@extends('layouts.app')

@section('title', $poll->question)

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Vote Now!</h3>
                </div>
                <div class="card-body">
                    <h4 class="mb-4">{{ $poll->question }}</h4>
                    
                    <form method="POST" action="{{ route('poll.vote', $poll) }}">
                        @csrf
                        
                        <ul class="list-group mb-4">
                            @foreach($poll->options as $option)
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <input class="form-check-input me-2" type="radio" name="option_id" 
                                               id="option{{ $option->id }}" value="{{ $option->id }}" required>
                                        <label class="form-check-label stretched-link" for="option{{ $option->id }}">
                                            {{ $option->text }}
                                        </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        
                        <button type="submit" class="btn btn-lg btn-success w-100">
                            Cast Your Vote!
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection