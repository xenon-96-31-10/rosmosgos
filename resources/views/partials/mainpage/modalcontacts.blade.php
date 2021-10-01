<!-- Modal -->
<div class="modal fade border shadow" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container text-center">
                    <h1 class="modal-title text-custom" id="exampleModalLongTitle" >Оставьте заявку</h1>
                    <p class="lead text-secondary">И мы с вами свяжемся </p>
                </div>
                <button type="button" class="close rounded" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form  method="post" action="{{ route('sendFeedback')}}">
                @csrf
                <div class="form-group">
                  <label for="nameclient2">Ваше Имя</label>
                  <input type="text" class="form-control" id="nameclient2" name="nameclient" placeholder="Иван">
                </div>
                <div class="form-group">
                  <label for="nameclient2">Ваш Телефон</label>
                  <input type="text" class="form-control" id="phoneclient2" name="phoneclient" placeholder="Ваш телефон">
                </div>
                <button type="submit" name="button" class="btn btn-custom btn-lg">Оправить заявку</button>
              </form>
            </div>
        </div>

    </div>
</div>
