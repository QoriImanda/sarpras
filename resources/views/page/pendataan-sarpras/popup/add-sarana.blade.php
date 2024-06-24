  <!-- Modal -->
  @php
      $kategoris = App\Models\Kategori::where('jenis', 'Sarana')->get();

      $roleUser = [];
      $roles = auth()->user()->roles;
      foreach ($roles as $role) {
          array_push($roleUser, $role->role_code);
      }

      $sarana = App\Models\Sarana::all();
  @endphp
  <form action="{{ route('pendataanSarpras.store', $menu) }}" method="post">
      @csrf
      @method('post')
      <div class="modal fade" id="add-sarana" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

          <div class="modal-dialog modal-fullscreen">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel" style="text-transform: capitalize;">Add
                          {{ $menu }}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="row g-2">
                          <div class="col-md mr-2">

                              @if (in_array('PJS', $roleUser))
                                  <input type="hidden" name="prasarana_id" value="{{ $prasarana->id }}">

                                  <div class="form-floating">
                                    <h5>Note : </h5>
                                      <h6>Ketika input data sarana, cari terlebih dahulu kode inventaris yang ingin di masukkan..., jika ada maka tidak perlu mengisi form yang lain cukup pilih sinkron kode inventaris...</h6>
                                      <h6>Jika kode inventaris yang dimaksud tidak ditemukan, pilih Data Baru pada sinkron kode inventaris, lalu lengkapi form untuk pengisian data sarana</h4>
                                  </div>

                                  <div class="form-floating mt-2">
                                      <select class="form-select" id="floatingSelect" name="kode_inventaris_id"
                                          aria-label="Floating label select example">
                                          <option value="" selected>Data baru</option>
                                          @foreach ($sarana as $item)
                                              <option value="{{ $item->kode_inventaris_id }}">{{ $item->kodeInventaris->gol }}.{{ $item->kodeInventaris->bid }}.{{ $item->kodeInventaris->kel }}.{{ $item->kodeInventaris->sub_kel }}.{{ $item->kodeInventaris->sub_sub }}.{{ $item->kodeInventaris->no_urut }}</option>
                                          @endforeach
                                      </select>
                                      <label for="floatingSelect">sinkron Kode inventaris</label>
                                  </div>

                                  <hr>
                                  <div class="row g-3 mb-2">
                                      <div class="col-md-2">
                                          <label for="inputGol" class="form-label">Gol</label>
                                          <input type="number" class="form-control" name="gol" value=""
                                              id="inputGol">
                                      </div>
                                      <div class="col-md-2">
                                          <label for="inputBid" class="form-label">Bid</label>
                                          <input type="number" class="form-control" name="bid" value=""
                                              id="inputBid">
                                      </div>
                                      <div class="col-md-2">
                                          <label for="inputKel" class="form-label">Kel</label>
                                          <input type="number" class="form-control" name="kel" value=""
                                              id="inputKel">
                                      </div>
                                      <div class="col-md-2">
                                          <label for="inputSubKel" class="form-label">Sub
                                              Kel</label>
                                          <input type="number" class="form-control" name="sub_kel" value=""
                                              id="inputSubKel">
                                      </div>
                                      <div class="col-md-2">
                                          <label for="inputSubSub" class="form-label">Sub
                                              Sub</label>
                                          <input type="number" class="form-control" name="sub_sub" value=""
                                              id="inputSubSub">
                                      </div>
                                      <div class="col-md-2">
                                          <label for="inputNoUrut" class="form-label">No.
                                              Urut</label>
                                          <input type="number" class="form-control" name="no_urut" value=""
                                              id="inputNoUrut">
                                      </div>
                                  </div>
                              @else
                                  <div class="row g-3 mb-2">
                                      <div class="col-md-2">
                                          <label for="inputGol" class="form-label">Gol</label>
                                          <input type="number" class="form-control" name="gol" value=""
                                              id="inputGol" required>
                                      </div>
                                      <div class="col-md-2">
                                          <label for="inputBid" class="form-label">Bid</label>
                                          <input type="number" class="form-control" name="bid" value=""
                                              id="inputBid" required>
                                      </div>
                                      <div class="col-md-2">
                                          <label for="inputKel" class="form-label">Kel</label>
                                          <input type="number" class="form-control" name="kel" value=""
                                              id="inputKel" required>
                                      </div>
                                      <div class="col-md-2">
                                          <label for="inputSubKel" class="form-label">Sub
                                              Kel</label>
                                          <input type="number" class="form-control" name="sub_kel" value=""
                                              id="inputSubKel" required>
                                      </div>
                                      <div class="col-md-2">
                                          <label for="inputSubSub" class="form-label">Sub
                                              Sub</label>
                                          <input type="number" class="form-control" name="sub_sub" value=""
                                              id="inputSubSub" required>
                                      </div>
                                      <div class="col-md-2">
                                          <label for="inputNoUrut" class="form-label">No.
                                              Urut</label>
                                          <input type="number" class="form-control" name="no_urut" value=""
                                              id="inputNoUrut" required>
                                      </div>
                                  </div>
                              @endif


                              <div class="form-floating mt-2">
                                  <input type="text" class="form-control" name="nama_sarana"
                                      id="floatingInputGrid" placeholder="xxxxxxxxx" value="">
                                  <label for="floatingInputGrid">Nama Sarana</label>
                              </div>

                              <div class="form-floating mt-2">
                                  <textarea class="form-control" name="desc" placeholder="" id="floatingTextarea"></textarea>
                                  <label for="floatingTextarea">Deskripsi</label>
                              </div>

                              <div class="form-floating mt-2">
                                  <select class="form-select" id="floatingSelect" name="jenis_sarana"
                                      aria-label="Floating label select example">
                                      <option value="" selected>Jenis Sarana</option>
                                      <option value="Barang Habis Pakai">Barang Habis Pakai</option>
                                      <option value="Barang Tidak Habis Pakai">Barang Tidak Habis Pakai</option>
                                  </select>
                                  <label for="floatingSelect">Pilih Jenis Sarana</label>
                              </div>

                              <div class="form-floating mt-2">
                                  <select class="form-select" id="floatingSelect" name="kategori_id"
                                      aria-label="Floating label select example">
                                      <option value="" selected>Pilih kategori</option>
                                      @foreach ($kategoris as $kategori)
                                          <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                                      @endforeach
                                  </select>
                                  <label for="floatingSelect">Kategori</label>
                              </div>

                          </div>
                          <div class="col-md mr-2">

                              <div class="form-floating">
                                  <input type="number" class="form-control" name="tahun_pengadaan"
                                      id="floatingInputGrid" placeholder="xxxxxxxxx" value="">
                                  <label for="floatingInputGrid">Tahun Pengadaan</label>
                              </div>

                              <div class="form-floating mt-2">
                                  <input type="number" class="form-control" name="jumlah" id="floatingInputGrid"
                                      placeholder="xxxxxxxxx" value="">
                                  <label for="floatingInputGrid">Jumlah</label>
                              </div>

                              <div class="form-floating mt-2">
                                  <input type="text" class="form-control" name="harga" id="floatingInputGrid"
                                      placeholder="xxxxxxxxx" value="">
                                  <label for="floatingInputGrid">Harga</label>
                              </div>

                              <div class="form-floating mt-2">
                                  <input type="text" class="form-control" name="lokasi_sarana"
                                      id="floatingInputGrid" placeholder="xxxxxxxxx" value="">
                                  <label for="floatingInputGrid">Lokasi</label>
                              </div>

                              {{-- <div class="form-floating mt-2">
                                  <textarea class="form-control" name="lokasi_prasarana" placeholder="" id="floatingTextarea"></textarea>
                                  <label for="floatingTextarea">Lokasi</label>
                              </div> --}}

                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Save</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
              </div>

          </div>
      </div>
  </form>
