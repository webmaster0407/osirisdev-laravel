@extends('layouts.admin')
@section('content')
<div class="content">
    @env(['dev', 'development', 'local'])
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="false">×</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i>DEV</h5>
            {{ trans('global.environment', ['env' => 'DEV']) }}
        </div>
    @endenv

    @env(['test', 'staging', 'qa'])
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="false">×</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i>TEST</h5>
            {{ trans('global.environment', ['env' => 'TEST']) }}
        </div>
    @endenv
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>



                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif



                    <div class="row">
                        <div class="{{ $settings1['column_class'] }}">

							<div class="info-box">
								  <span class="info-box-icon bg-danger"><i class="fa fa-users"></i></span>
								  <div class="info-box-content">
									<span class="info-box-text">{{ $settings1['chart_title'] }}</span>
									<span class="info-box-number">{{ number_format($settings1['total_number']) }}</span>
								  </div>
							</div>


                            <!-- /.info-box -->
                        </div>
                        <div class="{{ $settings2['column_class'] }}">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fa fa-briefcase-medical"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{ $settings2['chart_title'] }}</span>
                                    <span class="info-box-number">{{ number_format($settings2['total_number']) }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="{{ $settings3['column_class'] }}">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fa fa-calendar"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{ $settings3['chart_title'] }}</span>
                                    <span class="info-box-number">{{ number_format($settings3['total_number']) }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="{{ $settings4['column_class'] }}">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fa fa-pager"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{ $settings4['chart_title'] }}</span>
                                    <span class="info-box-number">{{ number_format($settings4['total_number']) }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        {{-- Widget - latest entries --}}
                        <div class="{{ $settings5['column_class'] }}" style="overflow-x: auto;">
                            <h3>{{ $settings5['chart_title'] }}</h3>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach($settings5['fields'] as $key => $value)
                                            <th>
                                                {{ trans(sprintf('cruds.%s.fields.%s', $settings5['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings5['data'] as $entry)
                                        <tr>
                                            @foreach($settings5['fields'] as $key => $value)
                                                <td>
                                                    @if($value === '')
                                                        {{ $entry->{$key} }}
                                                    @elseif(is_iterable($entry->{$key}))
                                                        @foreach($entry->{$key} as $subEentry)
                                                            <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                                        @endforeach
                                                    @else
                                                        {{ data_get($entry, $key . '.' . $value) }}
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="{{ count($settings5['fields']) }}">{{ __('No entries found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Widget - latest entries --}}
                        <div class="{{ $settings6['column_class'] }}" style="overflow-x: auto;">
                            <h3>{{ $settings6['chart_title'] }}</h3>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach($settings6['fields'] as $key => $value)
                                            <th>
                                                {{ trans(sprintf('cruds.%s.fields.%s', $settings6['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings6['data'] as $entry)
                                        <tr>
                                            @foreach($settings6['fields'] as $key => $value)
                                                <td>
                                                    @if($value === '')
                                                        {{ $entry->{$key} }}
                                                    @elseif(is_iterable($entry->{$key}))
                                                        @foreach($entry->{$key} as $subEentry)
                                                            <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                                        @endforeach
                                                    @else
                                                        {{ data_get($entry, $key . '.' . $value) }}
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="{{ count($settings6['fields']) }}">{{ __('No entries found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
@endsection
