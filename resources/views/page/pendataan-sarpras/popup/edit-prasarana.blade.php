  <!-- Modal -->
  @php
      $kategoris = App\Models\Kategori::where('jenis', 'Prasarana')->get();
  @endphp

  <div class="modal fade" id="edit-prasarana{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <form action="{{ route('pendataanSarpras.update', [$menu, $item->id]) }}" method="post">
          @csrf
          @method('put')
          <div class="modal-dialog modal-fullscreen">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel" style="text-transform: capitalize;">Edit
                          {{ $menu }}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="row g-2">
                          <div class="col-md mr-2">

                              <div class="row g-3 mb-2">
                                  <div class="col-md-2">
                                      <label for="inputGol" class="form-label">Gol</label>
                                      <input type="number" class="form-control" name="gol"
                                          value="{{ $item->kodeInventaris->gol }}" id="inputGol" required>
                                  </div>
                                  <div class="col-md-2">
                                      <label for="inputBid" class="form-label">Bid</label>
                                      <input type="number" class="form-control" name="bid"
                                          value="{{ $item->kodeInventaris->bid }}" id="inputBid" required>
                                  </div>
                                  <div class="col-md-2">
                                      <label for="inputKel" class="form-label">Kel</label>
                                      <input type="number" class="form-control" name="kel"
                                          value="{{ $item->kodeInventaris->kel }}" id="inputKel" required>
                                  </div>
                                  <div class="col-md-2">
                                      <label for="inputSubKel" class="form-label">Sub
                                          Kel</label>
                                      <input type="number" class="form-control" name="sub_kel"
                                          value="{{ $item->kodeInventaris->sub_kel }}" id="inputSubKel" required>
                                  </div>
                                  <div class="col-md-2">
                                      <label for="inputSubSub" class="form-label">Sub
                                          Sub</label>
                                      <input type="number" class="form-control" name="sub_sub"
                                          value="{{ $item->kodeInventaris->sub_sub }}" id="inputSubSub" required>
                                  </div>
                                  <div class="col-md-2">
                                      <label for="inputNoUrut" class="form-label">No.
                                          Urut</label>
                                      <input type="number" class="form-control" name="no_urut"
                                          value="{{ $item->kodeInventaris->no_urut }}" id="inputNoUrut" required>
                                  </div>
                              </div>

                              <div class="form-floating mt-2">
                                  <input type="text" class="form-control" name="nama_prasarana"
                                      id="floatingInputGrid" placeholder="xxxxxxxxx" value="{{ $item->nama_prasarana }}"
                                      required>
                                  <label for="floatingInputGrid">Nama Prasarana</label>
                              </div>

                              <div class="form-floating mt-2">
                                  <textarea class="form-control" name="desc" placeholder="" id="floatingTextarea">{{ $item->desc }}</textarea>
                                  <label for="floatingTextarea">Deskripsi</label>
                              </div>

                              <div class="form-floating mt-2">
                                  <select class="form-select" id="floatingSelect" name="kategori_id" required
                                      aria-label="Floating label select example">
                                      <option value="{{ $item->kategori_id }}">{{ $item->kategori->kategori }}</option>
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
                                      id="floatingInputGrid" placeholder="xxxxxxxxx" value="{{ $item->tahun_pengadaan }}" required>
                                  <label for="floatingInputGrid">Tahun Pengadaan</label>
                              </div>

                              <div class="form-floating mt-2">
                                  <input type="text" class="form-control" name="harga" id="floatingInputGrid"
                                      placeholder="xxxxxxxxx" value="{{ $item->harga }}" required>
                                  <label for="floatingInputGrid">Harga</label>
                              </div>

                              <div class="form-floating mt-2">
                                  <textarea class="form-control" name="lokasi_prasarana" placeholder="" id="floatingTextarea">{{ $item->lokasi_prasarana }}</textarea>
                                  <label for="floatingTextarea">Lokasi</label>
                              </div>

                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Save</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </form>

  </div>
