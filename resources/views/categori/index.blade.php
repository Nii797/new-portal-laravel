@extends('layouts.app')

@section('title', 'Categori')
@section('page-title','Home')

@push('customcss')
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}"></script>
@endpush
  @section('title','Dahboard')
  @section('page-title','Categori')
  @section('content')
  <!-- Default box -->
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Categori</h3>
      <div class="pull-right">
        <a href="{{ route('categori.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Nama Kategori</th>
          <th>Slug</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>

            @foreach ($categori as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_kategori }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>
                        <a href="{{ route('categori.edit',$item->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                        <a href="" class="btn btn-danger">
                            <span><i class="fa fa-trash"></i></span>
                            <form action="{{ route('categori.destroy',$item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
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
  @push('datatables')
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables/datatables.bootstrap.min.js') }}"></script>
  @endpush
  @push('customdatatables')
  <script>
    $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
    })
  </script>
  @endpush
  @endsection
