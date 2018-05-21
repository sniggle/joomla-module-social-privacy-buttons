<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<span class="d-none d-sm-block">
    <span class="total-shares">
        <?php echo JText::_('MOD_SOCIAL_PRIVACY_BUTTONS_REACTIONS') . '. '?>
        <span class="thx"><?php echo JText::_('MOD_SOCIAL_PRIVACY_BUTTONS_THANK_YOU') . '!'; ?></span>
    </span>
</span>
<ul class="social-sites">
  <?php if($params->get('show_facebook') == 1) {?>
    <li class="bg-facebook">
        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo JUri::current(); ?>" title="<?php echo JText::_('MOD_SOCIAL_PRIVACY_BUTTONS_SHARE_ON'); ?> Facebook"><i class="fa fa-facebook"></i><span class="fb-share d-none d-sm-inline">Share</span></a>
    </li>
  <?php } ?>
    <li class="bg-g-plus">
        <a target="_blank" href="https://plus.google.com/share?url=<?php echo JUri::current(); ?>" title="<?php echo JText::_('MOD_SOCIAL_PRIVACY_BUTTONS_SHARE_ON'); ?> Google+"><i class="fa fa-google-plus"></i><span class="gp-share d-none d-sm-inline">Share</span></a>
    </li>
    <li class="bg-linkedin">
        <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo JUri::current(); ?>&title=&summary=&source=" title="<?php echo JText::_('MOD_SOCIAL_PRIVACY_BUTTONS_SHARE_ON'); ?> LinkedIn"><i class="fa fa-linkedin"></i><span class="li-share d-none d-sm-inline">Share</span></a>
    </li>
    <li class="bg-pinterest">
        <a target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo JUri::current(); ?>&media=<?php echo $image; ?>&description=<?php echo urlencode($title); ?>" title="<?php echo JText::_('MOD_SOCIAL_PRIVACY_BUTTONS_SHARE_ON'); ?> Pinterest"><i class="fa fa-pinterest"></i><span class="pn-share d-none d-sm-inline">Pin it!</span></a>
    </li>
    <li class="bg-twitter">
        <a target="_blank" href="https://twitter.com/home?status=<?php echo JUri::current(); ?>" title="<?php echo JText::_('MOD_SOCIAL_PRIVACY_BUTTONS_SHARE_ON'); ?> Twitter"><i class="fa fa-twitter"></i><span class="tw-share d-none d-sm-inline">Tweet</span></a>
    </li>
    <li class="bg-mail d-none d-sm-inline">
        <a target="_blank" href="mailto:?subject=<?php echo JFactory::getDocument()->title; ?>&body=<?php echo JText::_('MOD_SOCIAL_PRIVACY_BUTTONS_CHECK_OUT_THIS_PAGE') . ': ' . JUri::current() . '%0A%0A%0A' . JText::_('MOD_SOCIAL_PRIVACY_BUTTONS_VISIT_US') . ' https://www.yoga-on-holiday.com/'; ?>" title="<?php echo JText::_('MOD_SOCIAL_PRIVACY_BUTTONS_SEND_VIA_EMAIL'); ?>"><i class="fa fa-envelope"></i><span>Mail</span></a>
    </li>
    <li class="bg-whatsapp d-inline d-sm-none">
        <a href="whatsapp://send?text=<?php echo JText::_('MOD_SOCIAL_PRIVACY_BUTTONS_CHECK_OUT_THIS_PAGE') . ': ' . JUri::current(); ?>" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a>
    </li>
</ul>
<script>
    jQuery.ajax({
        url: "<?php echo JUri::root(); ?>/index.php?option=com_ajax&module=social_privacy_buttons&method=getShares&url=<?php echo JUri::current();?>&format=raw",
        cache: false,
        dataType: 'json'
    })
            .done(function (html) {
                jQuery(".fb-share").html("Share I " + html.fb);
                jQuery(".gp-share").html("Share I " + html.gp);
                jQuery(".pn-share").html("Pin It! I " + html.pn);
                //jQuery(".tw-share").html("Tweet I " + html.tw);
                jQuery(".li-share").html("Share I " + html.li);
                var total = html.fb+html.gp+html.pn+html.li;
                jQuery(".total-shares").html(total+jQuery(".total-shares").html());
                if(total == 0) {
                    jQuery(".thx").remove();
                }
            });
</script>
