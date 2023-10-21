<div class="modal fade" id="kepentingan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah data user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
                <form action="/register_lembaga" method="post" class="row g-3" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">
                        <label for="yourName" class="form-label">Nama Lembaga</label>
                        <input autofocus type="text" name="nama_lembaga" class="form-control @error('nama_lembaga') is-invalid @enderror" id="validationServer01" required value="{{old('nama_lembaga')}}">
                        @error('nama_lembaga')
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
                        <select name="status_lembaga" class="form-control" id="exampleFormControlSelect1">
                            <option>--Pilih Level Lembaga--</option>
                            <option value="1">Disnaker Kab/kota</option>
                            <option value="2">Disdik</option>
                        </select>
                        @error('status_lembaga')
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