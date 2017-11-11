@extends('back.layout')

@section('title')
    {{ $title }}
@endsection

@section('button')
    <a href="{{ route('auto.index', ['class' => $class]) }}" class="btn btn-primary">Retour</a>
@endsection

@section('main')

    <form action="{{ route('auto.update', ['class' => $class, 'id' => $id]) }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <div class="row">
        	
        	@foreach($layout as $layout_key => $layout_value)
            <div class="col-md-{{ $layout_value['size'] }}">
				<div class="box box-success">
					<div class="box-header with-border">
        				<h3 class="box-title">{{ $layout_value['title'] }}</h3>
        			</div>
        			<div class="box-body">
        				@foreach($item as $item_key => $item_value)
        					@if ($item_value['section'] == $layout_key)
								{!! $item_value['html'] !!}
        					@endif
        				@endforeach
        			</div>
				</div>
            </div>
            @endforeach

        </div>
        <button type="submit" class="btn btn-primary">@lang('Submit')</button>
    </form>

@endsection