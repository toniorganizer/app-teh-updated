<div class="modal fade" id="tk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah data tenaga kerja</h5>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="addTenagaKerja" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                      <label for="inputName5" class="form-label">Username</label>
                      <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="inputName5" value="{{old('username')}}">
                      @error('username')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                      <label for="inputName5" class="form-label">Nama Lengkap</label>
                      <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="inputName5" value="{{old('nama')}}">
                      @error('nama')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="col-12">
                      <label for="inputAddress5" class="form-label">E-mail</label>
                      <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="inputAddres5s" value="{{old('email')}}">
                      @error('email')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="col-12">
                      <label for="inputAddress2" class="form-label">Alamat</label>
                      <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="inputAddress2" value="{{old('alamat')}}">
                      @error('alamat')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="col-12">
                      <label for="inputAddress2" class="form-label">Pendidikan</label>
                      <input type="text" name="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror" id="inputAddress2" value="{{old('pendidikan')}}">
                      @error('pendidikan')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="col-md-12">
                      <label for="inputCity" class="form-label">Keterampilan</label>
                      <input type="text" name="keterampilan" class="form-control @error('keterampilan') is-invalid @enderror" id="inputCity" value="{{old('keterampilan')}}">
                      @error('keterampilan')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="col-md-12">
                        <label for="inputCity" class="form-label">No. Handphone</label>
                        <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" id="inputCity" value="{{old('no_hp')}}">
                        @error('no_hp')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                    <div class="col-md-12">
                        <label for="inputCity" class="form-label">Tentang</label>
                        <textarea name="tentang" class="form-control @error('tentang') is-invalid @enderror" id="inputCity" value="{{old('tentang')}}"></textarea>
                        @error('tentang')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                    <div class="col-md-12">
                      <label for="inputCity" class="form-label">Foto</label>
                      <input class="form-control @error('foto') is-invalid @enderror" name="foto" type="file" id="formFile">
                      @error('foto')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                      <small id="emailHelp" class="form-text text-muted">File max. 150 KB</small>
                    </div>
                    <div class="col-md-6">
                        <label for="inputCity" class="form-label">password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="inputCity">
                        @error('password')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                      <div class="col-md-6">
                        <label for="inputCity" class="form-label">Ulangi Password</label>
                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="inputCity">
                        @error('password_confirmation')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>