  <div>
      <form action="{{ route('pemeliharaanSarpras.post') }}" method="post">
          @csrf
          @method('post')
          <div class="modal fade" id="pemeliharaan-sarpras{{ $item->id }}Genap" tabindex="-1"
              aria-labelledby="exampleModalLabel" aria-hidden="true">

              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel" style="text-transform: capitalize;">
                              Pemeliharaan
                              {{ $item->nama_sarana ?? ($item->nama_prasarana ?? ($item->sarpras($item->sarpras_id, $item->sarana_or_prasarana)->nama_prasarana ?? ($item->sarpras($item->sarpras_id, $item->sarana_or_prasarana)->nama_sarana ?? ''))) }}
                              | {{ $semester }}
                          </h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <div class="row g-2">
                              @if (in_array('PJS', $roleUser))
                                  @if ($sectionprasaranaSaranas ?? '' == true)
                                      <input type="hidden" name="sarpras_id" value="{{ $item->id }}">
                                  @else
                                      <input type="hidden" name="sarpras_id" value="{{ $item->sarpras_id }}">
                                  @endif
                              @else
                                  <input type="hidden" name="sarpras_id" value="{{ $item->id }}">
                              @endif
                              <input type="hidden" name="tahun_periode" value="{{ $thn }}">
                              <input type="hidden" name="sarana_or_prasarana"
                                  value="{{ $sarpras ?? $item->sarana_or_prasarana }}">
                              <input type="hidden" name="semester" value="{{ $semester }}">
                              {{-- <div class="col-md mr-2"> --}}
                              <div class="form-floating mt-2">
                                  <select class="form-select" id="floatingSelect" name="kondisi" required
                                      aria-label="Floating label select example">
                                      <option
                                          value="{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->kondisi ?? ($item->logPemeliharaanSarpras($item->sarpras_id, $thn, $semester)->kondisi ?? '') }}"
                                          selected>
                                          {{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->kondisi ?? ($item->logPemeliharaanSarpras($item->sarpras_id, $thn, $semester)->kondisi ?? 'Pilih Kondisi') }}
                                      </option>
                                      <option value="Terawat">Terawat</option>
                                      <option value="Rusak Ringan">Rusak Ringan</option>
                                      <option value="Rusak Berat">Rusak Berat</option>

                                  </select>
                                  <label for="floatingSelect">Kondisi</label>
                              </div>

                              <div class="form-floating mt-2">
                                  <textarea class="form-control" name="desc" placeholder="" style="height: 100px" id="floatingTextarea">{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->desc ?? ($item->logPemeliharaanSarpras($item->sarpras_id, $thn, $semester)->desc ?? '') }}</textarea>
                                  <label for="floatingTextarea">Keterangan</label>
                              </div>

                              <div class="form-floating mt-2">
                                  <textarea class="form-control" name="akar_masalah" placeholder="" style="height: 100px" id="floatingTextarea">{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->akar_masalah ?? ($item->logPemeliharaanSarpras($item->sarpras_id, $thn, $semester)->akar_masalah ?? '') }}</textarea>
                                  <label for="floatingTextarea">Akar Masalah</label>
                              </div>

                              <div class="form-floating mt-2">
                                  <textarea class="form-control" name="tindak_lanjut" placeholder="" style="height: 100px" id="floatingTextarea">{{ $item->logPemeliharaanSarpras($item->id, $thn, $semester)->tindak_lanjut ?? ($item->logPemeliharaanSarpras($item->sarpras_id, $thn, $semester)->tindak_lanjut ?? '') }}</textarea>
                                  <label for="floatingTextarea">Tindak Lanjut</label>
                              </div>

                              {{-- </div> --}}
                              {{-- <div class="col-md mr-2"> --}}

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

                              {{-- </div> --}}
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
  </div>
