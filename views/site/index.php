<?php
/* @var $this yii\web\View */
$this->title = 'COEEXAM';
?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Message displayed on the Board</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
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
                                data-type = "<?php echo $lastMessage->type;?>" 
                                style="<?php if($index == 1) { echo 'display:block;';} else { echo 'display:none;'; } ?>"
                            >
                                <div class="col-md-8">
                                    <?php
                                        echo $lastMessage->message;
                                        if($lastMessage->type == 2){?>
                                            <video class='img-responsive' controls>
                                                <source src="uploads/<?php echo $lastMessage->attachement;?>" >
                                            </video>
                                    <?php
                                        } else if($lastMessage->type == 3) {
                                    ?>
                                            <audio class='img-responsive' controls>
                                                <source src="uploads/<?php echo $lastMessage->attachement;?>">
                                            </audio>
											
											
											<?php
                                        } else if($lastMessage->type == 5) {
                                    ?>
                                            <pdf class='img-responsive' controls>
                                                <source src="uploads/<?php echo $lastMessage->attachement;?>">
                                            </pdf>
											
											
											
											
                                    <?php
                                        } else if($lastMessage->type == 4) {
                                    ?>
                                           <center> <img src="uploads/<?php echo $lastMessage->attachement;?>"  class="img-responsive"  ></img></center>
                                    <?php
                                        }
                                    ?>
                                </div>
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
            </div><!-- ./box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div>
<?php
    if($marqueMsg) {
?>
        <marquee class='marquee-sec'>
            <p>
                &nbsp;&nbsp;#&nbsp;&nbsp;
<?php
                foreach ($marqueMsg as $key => $value) {
                    echo $value->message;
                  echo "&nbsp;&nbsp;#&nbsp;&nbsp;";
                }
?>
            </p>
        </marquee>
<?php
    }
?>
<?php $this->beginBlock('scriptBlock'); ?>
    <script type="text/javascript">
        var index = 1;
        var intId;
        $(document).ready(function(){
            intId = setInterval(showSlide,50000);
        });
        function showSlide() {
            $('.slides').hide();
            index++;
            $('.slides').each(function(i, slide) {
                if(index == $(slide).data('index')) {
                    $(slide).show();
                    if($(slide).data('type') == 2) {
                        clearInterval(intId);
                        var video = $(slide).find('video');
                        video.trigger('play');
                        $(video).on('ended',function(){
                            intId = setInterval(showSlide,50000);                 
                        });
                    } else if($(slide).data('type') == 3) {
                        clearInterval(intId);
                        var audio = $(slide).find('audio');
                        audio.trigger('play');
                        $(audio).on('ended',function(){
                            intId = setInterval(showSlide,50000);                 
                        });
                    }
                }
            });
            if(index == $('.slides').length+1) {
                location.reload();
            }
        }
    </script>
<?php $this->endBlock();