@extends('layouts.admin')
@section('content')
@can('beasiswa_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.beasiswas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.beasiswa.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.beasiswa.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Beasiswa">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.beasiswa.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.beasiswa.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.beasiswa.fields.nim') }}
                        </th>
                        <th>
                            {{ trans('cruds.beasiswa.fields.jurusan') }}
                        </th>
                        <th>
                            {{ trans('cruds.beasiswa.fields.fakultas') }}
                        </th>
                        <th>
                            {{ trans('cruds.beasiswa.fields.index') }}
                        </th>
                        <th>
                            {{ trans('cruds.beasiswa.fields.beasiswa') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($beasiswas as $key => $beasiswa)
                        <tr data-entry-id="{{ $beasiswa->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $beasiswa->id ?? '' }}
                            </td>
                            <td>
                                {{ $beasiswa->name ?? '' }}
                            </td>
                            <td>
                                {{ $beasiswa->nim ?? '' }}
                            </td>
                            <td>
                                {{ $beasiswa->jurusan ?? '' }}
                            </td>
                            <td>
                                {{ $beasiswa->fakultas ?? '' }}
                            </td>   
                            <td>
                                {{ $beasiswa->indeks ?? '' }}
                            </td>   
                            <td>
                                {{ $beasiswa->beasiswa ?? '' }}
                            </td>   
                            
                            <td>
                                @can('beasiswa_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.beasiswas.show', $beasiswa->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('beasiswa_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.beasiswas.edit', $beasiswa->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('beasiswa_delete')
                                    <form action="{{ route('admin.beasiswas.destroy', $beasiswa->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('beasiswa_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.beasiswas.massDestroy') }}",
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
  let table = $('.datatable-Beasiswa:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection