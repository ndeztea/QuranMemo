<table class="table table-bordered">
	<thead>
		<tr class="active">
			<th width="10">No</th>
			<th>Surah</th>
			<th>Target</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
	<?php $a=0;?>
	@foreach($list as $row)
	<?php $a++;?>
	<tr>
		<td class="center">{{$a}}</td>
		<td class="center">{{$row->surah_start}}:{{$row->ayat_start}}-{{$row->ayat_end}}</td>
		<td  class="center">{{dayDiff($row->date_start,$row->date_end)->days}} hari</td>
		<td  class="center">@if($row->status==0) Belum Hafal @else Setor @endif</td>
	<tr>
	<tr>
		<td colspan="4">{{$row->note}}</td>
	</tr>
	<tr>
		<td colspan="4" class="center"><a href="{{url('memoz/surah/'.$row->surah_start.'/'.$row->ayat_start.'-'.$row->ayat_end.'/'.$row->id)}}"><i class="fa fa-sign-in"></i> Hafalkan</a>
			<a href=""><i class="fa fa-remove"></i> Hapus</a>
			<a href=""><i class="fa fa-edit"></i>  Edit</a></td>
	</tr>
	@endforeach
	</tbody>

</table>