<div class="modal fade" id="verifikasi-laporan{{$sidebar_data->id_pemangku_kepentingan}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header" role="document">
                <h5 class="modal-title" id="exampleModalLabel">Verifikasi laporan </h5><p class="font-weight-bold"> </p>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="/verifikasi-laporan" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">
                        <input type="hidden" name="email" value="{{$sidebar_data->email_lembaga}}">
                        <input type="hidden" name="id_disnaker_kab" value="{{$sidebar_data->id_disnaker_kab}}">
                        <label for="yourEmail" class="form-label">Status Laporan</label>
                        <select name="role_acc" class="form-control" id="exampleFormControlSelect2">
                            <option>--Pilih Status Laporan--</option>
                            <option value="2" {{ $sidebar_data->role_acc == 2 ? 'selected' : '' }}>Tidak disetujui</option>
                            <option value="1" {{ $sidebar_data->role_acc == 1 ? 'selected' : '' }}>Disetujui</option>
                        </select>
                        @error('id_disnaker_kab')
                        <small id="emailHelp" class="form-text text-muted">
                            {{$message}}
                        </small>
                        @enderror
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
