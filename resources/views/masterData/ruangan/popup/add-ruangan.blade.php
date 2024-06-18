  <!-- Modal -->
  @php
      use App\Models\Gedung;

      $gedungs = Gedung::orderBy('label_gedung', 'asc')->get();
  @endphp
  <div class="modal fade" id="add-ruangan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md">
          <form action="{{ route('ruangan.store') }}" method="post">
              @csrf
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add Ruangan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="form mb-3">
                          <label for="">Gedung</label>
                          <select class="form-control" id="gedung" name="gedung_id">
                              <option value="">Pilih Gedung</option>
                              @foreach ($gedungs as $gedung)
                                  <option value="{{ $gedung->id }}">{{ $gedung->label_gedung }}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="form-floating">
                          <input type="text" class="form-control" id="ruangan" name="ruangan"
                              placeholder="Password">
                          <label for="ruangan">Ruangan</label>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success btn-sm">Add</button>
                  </div>
              </div>
          </form>
      </div>
  </div>
