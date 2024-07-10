@extends('future::layouts.app')

@section('content')
    @if (config('future.future.widgets'))
        <div class="container-fuild mt-2">
            <div class="row row-cards">
                @foreach (config('future.future.widgets') as $widget)
                    <div class="row">
                        <div class="col">
                            {{$widget->render()}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div
    @endif
@endsection
