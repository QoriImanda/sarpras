  <!-- Modal -->


  <div class="modal fade modalSelectPJSarpras{{ $item->id }}" id="pj-sarpras{{ $item->id }}" tabindex="-1"
      aria-labelledby="exampleModalLabel" aria-hidden="true">
      <form action="{{ route('pjsarpras.post', $item->id) }}" method="post">
          @csrf
          @method('post')
          <div class="modal-dialog modal-md">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel" style="text-transform: capitalize;">Penanggung
                          Jawab Sarpras
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="row g-2">
                          <div class="col-md mr-2">

                              <div class="form-floating mb-4">
                                  <input type="hidden" name="sarpras" value="{{ $sarpras }}">
                                  <h5>Pilih Penanggung Jawab {{ $item->nama_sarana ?? $item->nama_prasarana }}</h5>
                                  <select class="form-select " id="selectpjsarpras{{ $item->id }}"
                                      style="width: 100%" name="user_id" data-placeholder="" required>
                                      <option selected value="{{ $item->pjSarpras($item->id)->user->id ?? 'Pilih PJ Sarpras!!' }}">
                                          {{ $item->pjSarpras($item->id)->user->userDetail->nama_lengkap ?? 'Pilih PJ Sarpras!!' }}
                                      </option>
                                      @foreach ($users as $user)
                                          <option value="{{ $user->id }}">
                                              {{ $user->nama_lengkap }}
                                          </option>
                                      @endforeach
                                  </select>
                              </div>

                              <div class="invalid-feedback">
                                  Silahkan pilih prodi!
                              </div>

                              <div class="col-md-8 col-lg-9">

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

  @section('script')
      <script>
          function pjsarpras(id) {
              console.log(id);
              $("#selectpjsarpras" + id).select2({
                  theme: 'bootstrap-5',
                  dropdownParent: '.modalSelectPJSarpras' + id
              });
          }
      </script>
  @endsection
