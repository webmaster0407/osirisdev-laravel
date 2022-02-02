@extends('layouts.admin')
@section('content')
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Competenceregistration">
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('competenceregistration_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.competenceregistrations.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.competenceregistrations.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'user_firstname', name: 'user.firstname' },
{ data: 'user.name', name: 'user.name' },
{ data: 'competence_name', name: 'competence.name' },
{ data: 'competence.key', name: 'competence.key' },
{ data: 'competence.type', name: 'competence.type' },
{ data: 'competence.color', name: 'competence.color' },
{ data: 'startdate', name: 'startdate' },
{ data: 'enddate', name: 'enddate' },
{ data: 'regnotes', name: 'regnotes' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Competenceregistration').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection