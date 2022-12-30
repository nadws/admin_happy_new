<div class="row" id="row{{$count}}">
    <div class="col-lg-3 mt-2">

        <select name="id_therapist[]" id="" class=" form-select">
            <option value="">--Pilih data--</option>
            @foreach ($therapist as $p)
            <option value="{{$p->id_therapy}}">{{$p->nama_therapy}} </option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-3 mt-2">

        <select name="id_paket[]" id="" class=" form-select pilih_paket" count="{{$count}}">
            <option value="">--Pilih data--</option>
            @foreach ($paket as $p)
            <option value="{{$p->id_paket}}">{{$p->nama_paket}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-lg-2 mt-2">

        <input type="number" name="jumlah[]" class="form-control jumlah jumlah{{$count}}" value="1" count="{{$count}}">
    </div>
    <div class="col-lg-3 mt-2">
        <input type="number" name="total_rp[]" class="form-control rp{{$count}}" readonly>
        <input type="hidden" class="form-control jlh{{$count}}">
    </div>
    <div class="col-lg-1 mt-2">
        <a href="#" class="btn btn-sm btn-warning remove_monitoring" count="{{$count}}"><i
                class="bi bi-dash-square-fill"></i></a>
    </div>
</div>