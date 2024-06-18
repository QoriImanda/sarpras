  <!-- Modal -->
  @php
      $kategoris = App\Models\Kategori::where('jenis', 'Prasarana')->get();
  @endphp
  <form action="{{ route('pendataanSarpras.store', $menu) }}" method="post">
      @csrf
      @method('post')
      <div class="modal fade" id="add-prasarana" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

                              <div class="form-floating">
                                  <input type="text" class="form-control" name="kode_inventaris"
                                      id="floatingInputGrid" placeholder="xxxxxxxxx" value="" required>
                                  <label for="floatingInputGrid">Kode Inventaris</label>
                              </div>

                              <div class="form-floating mt-2">
                                  <input type="text" class="form-control" name="nama_prasarana"
                                      id="floatingInputGrid" placeholder="xxxxxxxxx" value="" required>
                                  <label for="floatingInputGrid">Nama Prasarana</label>
                              </div>

                              <div class="form-floating mt-2">
                                  <textarea class="form-control" name="desc" placeholder="" id="floatingTextarea"></textarea>
                                  <label for="floatingTextarea">Deskripsi</label>
                              </div>

                              <div class="form-floating mt-2">
                                  <select class="form-select" id="floatingSelect" name="kategori_id" required
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

                              {{-- <div class="form-floating">
                                  <input type="number" class="form-control" name="tahun_pengadaan"
                                      id="floatingInputGrid" placeholder="xxxxxxxxx" value="" required>
                                  <label for="floatingInputGrid">Tahun Pengadaan</label>
                              </div> --}}

                              {{-- <div class="form-floating mt-2">
                              <input type="text" class="form-control" name="lokasi_prasarana" id="floatingInputGrid"
                                  placeholder="xxxxxxxxx" value="" required>
                              <label for="floatingInputGrid">Lokasi</label>
                                </div> --}}

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
