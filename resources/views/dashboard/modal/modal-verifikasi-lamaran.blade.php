<div class="modal fade" id="verifikasi-lamaran{{$data->id_lamar}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header" role="document">
                <h5 class="modal-title" id="exampleModalLabel">Verifikasi lowongan </h5><p class="font-weight-bold"> {{$data->nama_lengkap}}</p>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="{{ route('sumber.verifikasi', $data->id_lamar)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <div class="custom-control custom-radio">
                            <input type="hidden" name="email" value="{{$data->id_pelamar}}">
                            <input type="hidden" name="id_informasi" value="{{$data->id_informasi}}">
                            <input type="radio" id="customRadio1" name="status" class="custom-control-input" value="1" {{ $data->status == 1 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadio1">Proses pemeriksanaan lamaran</label>
                          </div>
                    </div>
                    <div class="col-md-12">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" name="status" class="custom-control-input" value="2" {{ $data->status == 2 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadio2">Pelamar masuk kriteria</label>
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
