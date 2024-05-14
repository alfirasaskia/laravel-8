@extends('layout.v_template')
@section('title', 'KOPERASI')
@section('content')

<a href="/koperasi/print" target="_blank" class="btn btn-primary">Print To Printer</a>
<a href="/koperasi/printpdf" target="_blank" class="btn btn-success">Print To PDF</a>

<table class="table table-bordered">
      <thead>
         <tr>
            <th>NO</th>
            <th>NO FAKTUR</th>
            <th>PELANGGAN</th>
            <th>TANGGAL</th>
            <th>TOTAL</th>
         </tr>
      </thead>
      <tbody>
            <?php $no=1; ?>
            @foreach($koperasi as $data)
               <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $data->faktur}}</td>
                  <td>{{ $data->pelanggan}}</td>
                  <td>{{ $data->tgl}}</td>
                  <td>{{ $data->total}}</td>
               </tr>
            @endforeach
      </tbody>
</table>

@endsection