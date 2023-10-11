<div class="modal fade" id="edit-verifikasi{{$data->id_informasi_lowongan}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header" role="document">
                <h5 class="modal-title" id="exampleModalLabel">Verifikasi lowongan </h5><p class="font-weight-bold"> {{$data->perusahaan}}</p>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="{{ route('lowongan.verifikasi', $data->id_informasi_lowongan)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1" name="verifikasi" class="custom-control-input" value="1" {{ $data->verifikasi == 1 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadio1">Disetujui</label>
                          </div>
                    </div>
                    <div class="col-md-12">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" name="verifikasi" class="custom-control-input" value="2" {{ $data->verifikasi == 2 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadio2">Tidak Disetujui</label>
                          </div>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>
