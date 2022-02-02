<div class="m-3">
    @can('competenceregistration_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.competenceregistrations.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.competenceregistration.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.competenceregistration.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-userCompetenceregistrations">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.competenceregistration.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.competenceregistration.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.competenceregistration.fields.competence') }}
                            </th>
                            <th>
                                {{ trans('cruds.competence.fields.key') }}
                            </th>
                            <th>
                                {{ trans('cruds.competence.fields.type') }}
                            </th>
                            <th>
                                {{ trans('cruds.competence.fields.color') }}
                            </th>
                            <th>
                                {{ trans('cruds.competenceregistration.fields.startdate') }}
                            </th>
                            <th>
                                {{ trans('cruds.competenceregistration.fields.enddate') }}
                            </th>
                            <th>
                                {{ trans('cruds.competenceregistration.fields.regnotes') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($competenceregistrations as $key => $competenceregistration)
                            <tr data-entry-id="{{ $competenceregistration->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $competenceregistration->id ?? '' }}
                                </td>
                                <td>
                                    {{ $competenceregistration->user->firstname ?? '' }}
                                </td>
                                <td>
                                    {{ $competenceregistration->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $competenceregistration->competence->name ?? '' }}
                                </td>
                                <td>
                                    {{ $competenceregistration->competence->key ?? '' }}
                                </td>
                                <td>
                                    @if($competenceregistration->competence)
                                        {{ $competenceregistration->competence::TYPE_SELECT[$competenceregistration->competence->type] ?? '' }}
                                    @endif
                                </td>
                                <td>
                                    {{ $competenceregistration->competence->color ?? '' }}
                                </td>
                                <td>
                                    {{ $competenceregistration->startdate ?? '' }}
                                </td>
                                <td>
                                    {{ $competenceregistration->enddate ?? '' }}
                                </td>
                                <td>
                                    {{ $competenceregistration->regnotes ?? '' }}
                                </td>
                                <td>
                                    @can('competenceregistration_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.competenceregistrations.show', $competenceregistration->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('competenceregistration_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.competenceregistrations.edit', $competenceregistration->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('competenceregistration_delete')
                                        <form action="{{ route('admin.competenceregistrations.destroy', $competenceregistration->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('competenceregistration_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.competenceregistrations.massDestroy') }}",
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
  let table = $('.datatable-userCompetenceregistrations:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection