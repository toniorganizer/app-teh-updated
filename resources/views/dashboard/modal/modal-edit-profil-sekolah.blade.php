<div class="modal fade" id="edit-bkk{{$data->id_bkk}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header" role="document">
                <h5 class="modal-title" id="exampleModalLabel">Edit data sekolah </h5><p class="font-weight-bold"> {{$data->nama_lengkap}}</p>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="{{ route('bursa.update', $data->email_sekolah) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-12">
                        <label for="inputAddress5" class="form-label">E-mail</label>
                        <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" id="inputAddres5s" value="{{$data->email_sekolah}}" readonly>
                        @error('email')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                    <div class="col-md-12">
                      <label for="inputName5" class="form-label">Nama Sekolah</label>
                      <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control @error('nama_sekolah') is-invalid @enderror" id="inputName5" value="{{$data->nama_sekolah}}">
                      @error('nama_sekolah')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="col-12">
                      <label for="inputAddress2" class="form-label">Alamat Sekolah</label>
                      <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" id="inputAddress2" value="{{$data->alamat_sekolah}}">
                      @error('alamat')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="col-12">
                      <label for="inputAddress2" class="form-label">Telepon Sekolah</label>
                      <input type="text" name="telepon" id="telepon" class="form-control @error('telepon') is-invalid @enderror" id="inputAddress2" value="{{$data->telepon_sekolah}}">
                      @error('telepon')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="col-md-12">
                      <label for="inputCity" class="form-label">Website Sekolah</label>
                      <input type="text" name="website" id="website" class="form-control @error('website') is-invalid @enderror" id="inputCity" value="{{$data->website_sekolah}}">
                      <small id="emailHelp" class="form-text text-muted">ex : www.smkn1kobes.sch.id</small>
                      @error('webiste')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="inputCity" class="form-label">Instagram Sekolah</label>
                        <input type="text" name="instagram" id="instagram" class="form-control @error('instagram') is-invalid @enderror" id="inputCity" value="{{$data->instagram_sekolah}}">
                        <small id="emailHelp" class="form-text text-muted">Masukan username instagram. Ex : smkn1kobes</small>
                        @error('instagram')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                    <div class="col-md-12">
                        <label for="inputCity" class="form-label">Facebook Sekolah</label>
                        <input name="facebook" id="facebook" class="form-control @error('facebook') is-invalid @enderror" id="inputCity" value="{{$data->facebook_sekolah}}">
                        <small id="emailHelp" class="form-text text-muted">Masukan username facebook. Ex : smkn1kotobesar</small>
                        @error('facebook')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                    <div class="col-md-12">
                      <label for="inputCity" class="form-label">Foto Sekolah</label><br>
                      <img src="
                      @if($data->foto_sekolah == 'default.jpg')
                        {{ Storage::url('public/user/default/').$data->foto_sekolah}}
                        @else
                        {{ Storage::url('public/user/').$data->foto_sekolah}}
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
        </div>
    </div>
</div>
