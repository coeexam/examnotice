<?php
/* @var $this yii\web\View */
$this->title = 'COEEXAM';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 align-center">
            <?php
                    if($lastMessages) {
                        $index = 0;
                        foreach($lastMessages as $lastMessage) {
                            $index ++;
                ?>
                            <div 
                                id="message-<?php echo $lastMessage->id; ?>" 
                                class="slides" 
                                data-index="<?php echo $index; ?>" 
                                data-type = "<?php echo $lastMessage->type; ?>" 
                                style="<?php if($index == 1) { echo <p>'display:block<br>;'; } else { echo 'display:none<br>;'; } ?>"
                            >
                                <?php
                                    echo "<p>".$lastMessage->message."</p>";
                                    if($lastMessage->type == 2){?>
                                        <div align="center" class="img-responsive" style="padding-top:50px;">
                                            <video class="img-responsive">
                                                <source  src="uploads/<?php echo $lastMessage->attachement;?>">
                                            </video>
                                        </div>
                                <?php
                                    } else if($lastMessage->type == 3) {
                                ?>
                                        <div align="center" class="img-responsive" style="padding-top:50px;">
                                            <audio class="img-responsive">
                                                <source src="uploads/<?php echo $lastMessage->attachement;?>" type="audio/mpeg">
                                            </audio>
                                        </div>
										
										<?php
                                    } else if($lastMessage->type == 5) {
                                ?>
                                        <div align="center" class="img-responsive" style="padding-top:50px;">
                                            <pdf class="img-responsive">
                                                <source src="uploads/<?php echo $lastMessage->attachement;?>" type="pdf/pdf">
                                            </pdf>
                                        </div>
										
										
										
										
                                <?php
                                    } else if($lastMessage->type == 4) {
                                ?>
                                        <center><img src="uploads/<?php echo $lastMessage->attachement;?>" class="img-responsive" style="padding-top:60px;padding-left:200px"></img></center>
                                <?php
                                    }
                                ?>
                            </div>
                <?php   }
                    } else { ?>
                        <div class="error-page">
                            <h2 class="headline text-yellow">0</h2>
                            <div class="error-content">
                              <h3><i class="fa fa-warning text-yellow"></i> Oops! No records found on the table</h3>
                              <p>
                                There are no messages found on the table. Please create one.
                              </p>
                            </div><!-- /.error-content -->
                        </div>
                <?php
                    }
                ?>

        </div>
    </div>
</div>
<?php
    if($marqueMsg) {
?>
        <div class='marquee-sec'>
            <p>
                &nbsp;&nbsp;||&nbsp;&nbsp;
<?php
                foreach ($marqueMsg as $key => $value) {
                  echo $value->message;
                    echo "&nbsp;&nbsp;||&nbsp;&nbsp;";
                }
?>
            </p>
        </div>
<?php
    }
?>

<style type="text/css">
    .align-center {
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        float:none;
        margin:0 auto;
    }
    .align-center img {
        max-height: 100%;
        max-width: 100%;
    }
    .align-center p {
        width:100%;
        background:rgba(255,255,255,0.25);
        font-size: 45px;
        position: absolute;
        top:20px;
		padding-left:25px;
        padding-right: 25px;
    }
    .marquee-sec {
        background:rgba(255,255,255,0.25);
        font-size:40px;
        position: absolute;
        bottom:30px;
				
    }
</style>