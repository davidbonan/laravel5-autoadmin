@extends('back.layout')

@section('title')
    {{ $title }}
@endsection

@section('button')
    <a href="{{ route('auto.create', ['class' => $class]) }}" class="btn btn-primary">Nouveau</a>
@endsection

@section('main')
	<div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            @foreach($columns as $key => $value)
                            <td>{{ $value['title'] }}</td>
                            @endforeach
                            <td width="20"></td>
                            <td width="20"></td>
                        </tr>
                        </thead>
                        <tbody id="pannel">                            
                            @foreach($items as $item)
                            <tr>
                                @foreach($columns as $key => $value)
                                <td>{!! $item[$key] !!}</td>
                                @endforeach
                                <td>
                                    <a  class="btn btn-warning btn-xs btn-block" 
                                        href="{{ route( 'auto.edit', ['class' => $class, 'id' => $item['id']] ) }}" 
                                        role="button" 
                                        title="@lang('Edit')">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                </td>
                                <td>
                                    <a  class="btn btn-danger btn-xs btn-block" 
                                        href="{{ route('auto.destroy', ['class' => $class, 'id' => $item['id']] ) }}" 
                                        role="button" 
                                        title="@lang('Destroy')">
                                        <span class="fa fa-remove"></span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection