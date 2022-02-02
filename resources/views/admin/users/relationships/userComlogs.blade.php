<div class="m-3">
    @can('comlog_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.comlogs.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.comlog.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.comlog.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-userComlogs">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.comlog.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.comlog.fields.from') }}
                            </th>
                            <th>
                                {{ trans('cruds.comlog.fields.to') }}
                            </th>
                            <th>
                                {{ trans('cruds.comlog.fields.subject') }}
                            </th>
                            <th>
                                {{ trans('cruds.comlog.fields.message') }}
                            </th>
                            <th>
                                {{ trans('cruds.comlog.fields.type') }}
                            </th>
                            <th>
                                {{ trans('cruds.comlog.fields.extrainfo') }}
                            </th>
                            <th>
                                {{ trans('cruds.comlog.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.name') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comlogs as $key => $comlog)
                            <tr data-entry-id="{{ $comlog->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $comlog->id ?? '' }}
                                </td>
                                <td>
                                    {{ $comlog->from ?? '' }}
                                </td>
                                <td>
                                    {{ $comlog->to ?? '' }}
                                </td>
                                <td>
                                    {{ $comlog->subject ?? '' }}
                                </td>
                                <td>
                                    {{ $comlog->message ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Comlog::TYPE_SELECT[$comlog->type] ?? '' }}
                                </td>
                                <td>
                                    {{ $comlog->extrainfo ?? '' }}
                                </td>
                                <td>
                                    {{ $comlog->user->firstname ?? '' }}
                                </td>
                                <td>
                                    {{ $comlog->user->name ?? '' }}
                                </td>
                                <td>
                                    @can('comlog_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.comlogs.show', $comlog->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('comlog_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.comlogs.edit', $comlog->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('comlog_delete')
                                        <form action="{{ route('admin.comlogs.destroy', $comlog->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('comlog_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.comlogs.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-userComlogs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection