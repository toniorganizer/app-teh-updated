<div class="modal fade" id="kepentingan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah data pemangku kepentingan</h5>
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
                            <option>--Pilih Level--</option>
                            <option value="2">Disdik</option>
                            <option value="3">Kadis Disnaker Kab/Kota</option>
                            <option value="1">Disnaker Kab/kota</option>
                        </select>
                        @error('status_lembaga')
                        <small id="emailHelp" class="form-text text-muted">
                            {{$message}}
                        </small>
                        @enderror
                    </div>

                    <!-- Form untuk level 3 -->
                    <div class="col-12" id="formLevel3" style="display: none;">
                        <label for="yourEmail" class="form-label">Disnaker Kab/Kota</label>
                        <select name="id_disnaker_kab" class="form-control" id="exampleFormControlSelect1">
                            <option>--Pilih Disnaker Kab/Kota--</option>
                            <option value="disnaker_agam@gmail.com">Kab. Agam</option>
                            <option value="disnaker_dharmasraya@gmail.com">Kab. Dharmasraya</option>
                            <option value="disnaker_mentawai@gmail.com">Kab. Kepulauan Mentawai</option>
                            <option value="disnaker_limapuluhkota@gmail.com">Kab. Limapuluh Kota</option>
                            <option value="disnaker_padangpariaman@gmail.com">Kab. Padang Pariaman</option>
                            <option value="disnaker_pasaman@gmail.com">Kab. Pasaman</option>
                            <option value="disnaker_pasbar@gmail.com">Kab. Pasaman Barat</option>
                            <option value="disnaker_pesel@gmail.com">Kab. Pesisir Selatan</option>
                            <option value="disnaker_sijunjung@gmail.com">Kab. Sijunjung</option>
                            <option value="disnaker_kabsolok@gmail.com">Kab. Solok</option>
                            <option value="disnaker_solsel@gmail.com">Kab. Solok Selatan</option>
                            <option value="disnaker_tananhdatar@gmail.com">Kab. Tanah Datar</option>
                            <option value="disnaker_bukittinggi@gmail.com">Kota Bukittinggi</option>
                            <option value="disnaker_padang@gmail.com">Kota Padang</option>
                            <option value="disnaker_pp@gmail.com">Kota Padang Panjang</option>
                            <option value="disnaker_pariaman@gmail.com">Kota Pariaman</option>
                            <option value="disnaker_payakumbuh@gmail.com">Kota Payakumbuh</option>
                            <option value="disnaker_sawahlunto@gmail.com">Kota Sawahlunto</option>
                            <option value="disnaker_solok@gmail.com">Kota Solok</option>
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