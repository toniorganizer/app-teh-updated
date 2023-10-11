<div class="modal fade" id="test" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah data user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
                <form action="/register_user" method="post" class="row g-3" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">
                        <label for="yourName" class="form-label">Nama User</label>
                        <input autofocus type="text" name="nama_user" class="form-control @error('nama_user') is-invalid @enderror" id="validationServer01" required value="{{old('nama_user')}}">
                        @error('nama_user')
                            <small id="passwordHelpBlock" class="form-text text-muted">
                                {{$message}}
                              </small>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="yourUsername" class="form-label">E-mail</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="validationServer02" required value="{{old('email')}}">
                        </div>
                        @error('email')
                            <small id="passwordHelpBlock" class="form-text text-muted">
                                {{$message}}
                              </small>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="yourEmail" class="form-label">Level</label>
                        <select name="level" class="form-control" id="exampleFormControlSelect1">
                            <option>--Pilih Level User--</option>
                            <option value="2">Pencari Kerja</option>
                            <option value="3">Pemangku Kepentingan</option>
                            <option value="4">Industri/Kadin</option>
                            <option value="5">Bursa Kerja Khusus</option>
                        </select>
                        @error('level')
                        <small id="emailHelp" class="form-text text-muted">
                            {{$message}}
                        </small>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="yourEmail" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="validationServer03" required value="{{old('username')}}">
                        @error('username')
                            <small id="passwordHelpBlock" class="form-text text-muted">
                                {{$message}}
                              </small>
                        @enderror
                    </div>


                    <div class="col-6">
                        <label for="yourPassword" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="validationServer04" required>
                        @error('password')
                            <small id="passwordHelpBlock" class="form-text text-muted">
                                {{$message}}
                              </small>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="yourPassword" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="ulangi_password" class="form-control @error('ulangi_password') is-invalid @enderror" id="validationServer05Feedback" required>
                        @error('ulangi_password')
                            <small id="passwordHelpBlock" class="form-text text-muted">
                                {{$message}}
                              </small>
                        @enderror
                    </div>
                    <div class="col-12">
                        <button  type="submit" class="btn btn-primary w-100">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>