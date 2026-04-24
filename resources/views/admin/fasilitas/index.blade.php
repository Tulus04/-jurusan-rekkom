@extends('layouts.admin')
@section('title', 'Kelola Fasilitas')
@push('styles')<link rel="stylesheet" href="{{ asset('admin/vendor/datatables/datatables.min.css') }}">@endpush
@section('content')
<div class="container-lg px-0">
    <nav aria-label="breadcrumb" class="mb-4 mt-3"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li><li class="breadcrumb-item active">Fasilitas</li></ol></nav>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Kelola Fasilitas</h1>
        <a href="{{ route('admin.fasilitas.create') }}" class="btn btn-primary">+ Tambah Fasilitas</a>
    </div>
    <div class="card mb-4"><div class="card-body">
        <table id="fasilitas-table" class="table table-striped table-hover align-middle" style="width:100%">
            <thead><tr><th width="5%">No</th><th width="10%">Gambar</th><th>Nama</th><th width="10%">Icon</th><th width="8%">Urutan</th><th width="8%">Status</th><th width="12%">Aksi</th></tr></thead>
        </table>
    </div></div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('admin/vendor/datatables/datatables.min.js') }}"></script>
<script>
$(document).ready(function(){
    var table=$('#fasilitas-table').DataTable({processing:true,serverSide:true,ajax:'{{ route("admin.fasilitas.datatable") }}',
        columns:[{data:'DT_RowIndex',orderable:false,searchable:false},{data:'gambar_preview',orderable:false,searchable:false},{data:'nama'},{data:'icon'},{data:'urutan'},{data:'status',orderable:false,searchable:false},{data:'aksi',orderable:false,searchable:false}],
        language:{url:'https://cdn.datatables.net/plug-ins/2.1.8/i18n/id.json'}});
    $(document).on('click','.btn-delete',function(e){e.preventDefault();var url=$(this).data('url'),nama=$(this).data('nama');
        Swal.fire({title:'Hapus Fasilitas?',text:'Data "'+nama+'" akan dihapus.',icon:'warning',showCancelButton:true,confirmButtonColor:'#e55353',cancelButtonColor:'#636f83',confirmButtonText:'Ya, Hapus!',cancelButtonText:'Batal'}).then(r=>{
            if(r.isConfirmed){$.ajax({url:url,type:'DELETE',success:function(r){Swal.fire('Berhasil!',r.message,'success');table.ajax.reload();},error:function(){Swal.fire('Gagal!','Terjadi kesalahan.','error');}});}});});
});
</script>
@endpush
