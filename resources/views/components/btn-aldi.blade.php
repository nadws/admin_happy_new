<div>
    <a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="btn icon icon-left btn-primary"
        style="float: right;"><i class="bi bi-plus"></i>
        Buat Invoice Baru</a>
    @if ($user =='Presiden')
        
    <a href="#" data-bs-toggle="modal" data-bs-target="#export" class="btn icon icon-left btn-primary"
        style="float: right; margin-right: 5px;"><i class="bi bi-file-excel"></i>
        Export {{$teks}}</a>
    @endif

</div>
