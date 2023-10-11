<div class="modal fade" id="edit-pk{{$data->id_pemangku_kepentingan}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header" role="document">
                <h5 class="modal-title" id="exampleModalLabel">Edit data sekolah </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="{{ route('pemerintah.update', $data->email_lembaga) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-12">
                        <label for="inputAddress5" class="form-label">E-mail</label>
                        <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" id="inputAddres5s" value="{{$data->email_lembaga}}" readonly>
                        @error('email')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                    <div class="col-md-12">
                      <label for="inputName5" class="form-label">Nama Lembaga</label>
                      <input type="text" name="nama_lembaga" id="nama_lembaga" class="form-control @error('nama_lembaga') is-invalid @enderror" id="inputName5" value="{{$data->nama_lembaga}}">
                      @error('nama_lembaga')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="col-12">
                      <label for="inputAddress2" class="form-label">Alamat Lembaga</label>
                      <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" id="inputAddress2" value="{{$data->alamat_lembaga}}">
                      @error('alamat')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="col-12">
                        <label for="inputAddress2" class="form-label">Bidang Lembaga</label>
                        <input type="text" name="bidang" id="bidang" class="form-control @error('bidang') is-invalid @enderror" id="inputAddress2" value="{{$data->bidang_lembaga}}">
                        @error('bidang')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                    <div class="col-12">
                      <label for="inputAddress2" class="form-label">Telepon Lembaga</label>
                      <input type="text" name="telepon" id="telepon" class="form-control @error('telepon') is-invalid @enderror" id="inputAddress2" value="{{$data->telepon_lembaga}}">
                      @error('telepon')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="col-md-12">
                      <label for="inputCity" class="form-label">Website Lembaga</label>
                      <input type="text" name="website" id="website" class="form-control @error('website') is-invalid @enderror" id="inputCity" value="{{$data->website_lembaga}}">
                      <small id="emailHelp" class="form-text text-muted">ex : www.smkn1kobes.sch.id</small>
                      @error('webiste')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="inputCity" class="form-label">Instagram Lembaga</label>
                        <input type="text" name="instagram" id="instagram" class="form-control @error('instagram') is-invalid @enderror" id="inputCity" value="{{$data->instagram_lembaga}}">
                        <small id="emailHelp" class="form-text text-muted">Masukan username instagram. Ex : disnakertrans</small>
                        @error('instagram')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                    <div class="col-md-12">
                        <label for="inputCity" class="form-label">Facebook Lembaga</label>
                        <input name="facebook" id="facebook" class="form-control @error('facebook') is-invalid @enderror" id="inputCity" value="{{$data->facebook_lembaga}}">
                        <small id="emailHelp" class="form-text text-muted">Masukan username facebook. Ex : disnakertrassmb</small>
                        @error('facebook')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                    <div class="col-md-12">
                      <label for="inputCity" class="form-label">Foto Lembaga</label><br>
                      <img src="
                      @if($data->foto_lembaga == 'default.jpg')
                        {{ Storage::url('public/user/default/').$data->foto_lembaga}}
                        @else
                        {{ Storage::url('public/user/').$data->foto_lembaga}}
                        @endif
                      " width="100" height="40" class="img-thumbnail mb-2" alt="">
                      <input class="form-control @error('foto') is-invalid @enderror" name="foto" id="foto"type="file" id="formFile">
                      @error('foto')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                      <small id="emailHelp" class="form-text text-muted">File max. 150 KB</small>
                    </div>
                    <div class="col-12">
                        <button  type="submit" class="btn btn-primary w-100">Update Data</button>
                    </div>
            </div>
        </form>
        </div>
    </div>
</div>
