<div class="m-3">
    @can('prevregistration_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.prevregistrations.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.prevregistration.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.prevregistration.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-prevPrevregistrations">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.prevregistration.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.prevregistration.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.prevregistration.fields.prev') }}
                            </th>
                            <th>
                                {{ trans('cruds.prev.fields.date') }}
                            </th>
                            <th>
                                {{ trans('cruds.prevregistration.fields.regnotes') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prevregistrations as $key => $prevregistration)
                            <tr data-entry-id="{{ $prevregistration->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $prevregistration->id ?? '' }}
                                </td>
                                <td>
                                    {{ $prevregistration->user->firstname ?? '' }}
                                </td>
                                <td>
                                    {{ $prevregistration->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $prevregistration->prev->name ?? '' }}
                                </td>
                                <td>
                                    {{ $prevregistration->prev->date ?? '' }}
                                </td>
                                <td>
                                    {{ $prevregistration->regnotes ?? '' }}
                                </td>
                                <td>
                                    @can('prevregistration_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.prevregistrations.show', $prevregistration->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('prevregistration_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.prevregistrations.edit', $prevregistration->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('prevregistration_delete')
                                        <form action="{{ route('admin.prevregistrations.destroy', $prevregistration->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('prevregistration_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.prevregistrations.massDestroy') }}",
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
  let table = $('.datatable-prevPrevregistrations:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection