  <div class="modal fade" id="light-box-sessions" data-lng="<?=$this->lang->line('session_0')?>">
    <div class="modal-dialog div-lightbox">
      <div class="modal-content lightbox-content">
        <div class="modal-header header-lightbox">

          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title text-center head-modal"><?=$this->lang->line('session_4')?></h4>

        </div>

        <div class="modal-body">

          <img class="center-block img-lightbox" src="<?=base_url()?>img/lightbox/checkin_icon.png" alt="">
          <h5 class="text-center text-modal"><?=$this->lang->line('session_1');?></h5>
          <div class="text-center container-buttons">
            <button class="btn btn-default btn-lg btn-lightbox btn-no" data-button="n"><?=$this->lang->line('session_2')?></button>
            <button class="btn btn-success btn-lg btn-lightbox btn-yes" data-button="y"><?=$this->lang->line('session_3')?></button>

          </div>
        </div>
      </div>
    </div>
  </div>