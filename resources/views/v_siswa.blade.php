@extends('layout.v_template')
@section('title', 'SISWA')
@section('content')


<table class="table table-bordered">
      <thead>
         <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Mata Pelajaran</th>
         </tr>
      </thead>
      <tbody>
            <?php $no=1; ?>
            @foreach($siswa as $data)
               <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $data->nis}}</td>
                  <td>{{ $data->nama_siswa}}</td>
                  <td>{{ $data->kelas}}</td>
                  <td>{{ $data->mapel}}</td>
                  
               </tr>
            @endforeach
      </tbody>
</table>

@endsection