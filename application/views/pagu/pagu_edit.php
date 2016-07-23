<?php
$this->load->view("info_header");
?>
<!-- Main Content -->
<div class="app-container-slide">
    <div class="container-fluid">
        <div class="side-body" style="padding-top:45px ;margin-left: 90px;margin-right: 30px">

            <div class="row  no-margin-bottom">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body no-padding">
                                <form action="<?=base_url()?>Pagu/updatePagu" method="POST">
                                <input type="hidden" name="id" value="<?=$pagu['ID_PAGU']?>">
                                    <input type="text" name="pagu" value="<?=$pagu['PAGU_ALAT']?>" />
                                    <button type="submit">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



