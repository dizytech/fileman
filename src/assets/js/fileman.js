$modal = $(`<div class="modal fade" id="modal-fileman" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Fileman</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <iframe src="/dizytech/fileman" frameborder="0" style="width : 100%; height: 400px; overflow: hidden;"></iframe>
                        </div>
                    </div>
                </div>
            </div>`);
$('body').append($modal);
$.fn.fileman = function (type, options) {
    type = type || 'file';
    this.on('click', function (e) {
        id = 0
        inputid = '';
        if ($(this).data('id') != null) {
            id = $(this).data('id');
        }
        if ($(this).data('input') != null) {
            inputid = $(this).data('input');
        }
        $('#modal-fileman').find('iframe').attr('src', '/dizytech/fileman#/files?id=' + id + '&input=' + inputid);
        $('#modal-fileman').find('iframe')[0].contentDocument.location.reload();
        $('#modal-fileman').modal('show');
    })
}