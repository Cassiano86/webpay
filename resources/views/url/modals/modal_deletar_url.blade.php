<!-- Modal -->
<div class="modal fade" id="modalDeletarUrl" tabindex="-1" role="dialog" aria-labelledby="modalDeletarUrl" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDeletarUrl">Deletar url permanentemente?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="form_deletar_url">
          @csrf
          @method('delete')
          <div class="row d-flex justify-content-end">
            <button type="submit" class="btn btn-danger rounded mr-2">
              <i class="{{config('app.material')}}">delete_forever</i> Deletar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>