<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="login-page">
    <?=$content?>
<?php $this->endBody() ?>
<script type="text/javascript">
	var index = 1;
    var intId;
    $(document).ready(function(){
        $('.marquee-sec').marquee();
        intId = setInterval(showSlide,10000);
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
                        intId = setInterval(showSlide,5000);                 
                    });
                } else if($(slide).data('type') == 3) {
                    clearInterval(intId);
                    var audio = $(slide).find('audio');
                    audio.trigger('play');
                    $(audio).on('ended',function(){
                        intId = setInterval(showSlide,5000);                 
                    });
                }
				
				
				else if($(slide).data('type') == 6) {
                    clearInterval(intId);
                    var audio = $(slide).find('pdf');
                    audio.trigger('play');
                    $(audio).on('ended',function(){
                        intId = setInterval(showSlide,5000);                 
                    });
                }
				
				
				
				
				
				
            }
        });
        if(index > $('.slides').length) {
            location.reload();
        }
    }
(function($) {
        $.fn.textWidth = function(){
             var calc = '<span style="display:none">' + $(this).text() + '</span>';
             $('body').append(calc);
             var width = $('body').find('span:last').width();
             $('body').find('span:last').remove();
            return width;
        };
        
        $.fn.marquee = function(args) {
            var that = $(this);
            var textWidth = that.textWidth(),
                offset = that.width(),
                width = offset,
                css = {
                    'text-indent' : that.css('text-indent'),
                    'overflow' : that.css('overflow'),
                    'white-space' : that.css('white-space')
                },
                marqueeCss = {
                    'text-indent' : width,
                    'overflow' : 'hidden',
                    'white-space' : 'nowrap'
                },
                args = $.extend(true, { count: -1, speed: 1e1, leftToRight: false }, args),
                i = 0,
                stop = textWidth*-1,
                dfd = $.Deferred();
            
            function go() {
                if(!that.length) return dfd.reject();
                if(width == stop) {
                    i++;
                    if(i == args.count) {
                        that.css(css);
                        return dfd.resolve();
                    }
                    if(args.leftToRight) {
                        width = textWidth*-1;
                    } else {
                        width = offset;
                    }
                }
                that.css('text-indent', width + 'px');
                if(args.leftToRight) {
                    width++;
                } else {
                    width--;
                }
                setTimeout(go, args.speed);
            };
            if(args.leftToRight) {
                width = textWidth*-1;
                width++;
                stop = offset;
            } else {
                width--;            
            }
            that.css(marqueeCss);
            go();
            return dfd.promise();
        };
    })(jQuery);
</script>
</body>
</html>
<?php $this->endPage() ?>
