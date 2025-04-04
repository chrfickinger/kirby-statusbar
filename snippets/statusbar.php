<?php

if (!$kirby->user()) return;

if (option('chrfickinger.kirby-statusbar.active') !== true) return;

    use Kirby\Panel\Panel;

    // User language
    kirby()->setCurrentTranslation(kirby()->user()->language());

    // Page status
    if($page->isListed()):
        $pagestatus = '<svg aria-hidden="true" viewBox="0 0 24 24" class="status" fill="#A8D451"><path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"></path></svg>';
    elseif($page->isUnlisted()):
        $pagestatus = '<svg aria-hidden="true" viewBox="0 0 24 24" class="status" fill="#63A1DE"><path d="M12 21.9966C6.47715 21.9966 2 17.5194 2 11.9966C2 6.47373 6.47715 1.99658 12 1.99658C17.5228 1.99658 22 6.47373 22 11.9966C22 17.5194 17.5228 21.9966 12 21.9966ZM12 19.9966V3.99658C7.58172 3.99658 4 7.5783 4 11.9966C4 16.4149 7.58172 19.9966 12 19.9966Z"></path></svg>';
    else:
        echo '<svg aria-hidden="true" viewBox="0 0 24 24" class="status" fill="#EC5556"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20Z"></path></svg>';
    endif;

    // User avatar
    if (kirby()->user()->avatar()):
        $avatar = '<img src="'.kirby()->user()->avatar()->thumb(['width' => 64, 'height' => 64, 'crop' => true, 'quality' => 90])->url().'" alt="'.t('view.account').'" />';
    else:
        $avatar = '<svg aria-hidden="true" aria-labelledby="account" viewBox="0 0 24 24"><title id="account">'.t('view.account').'</title><g><path d="M12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2ZM12.1597 16C10.1243 16 8.29182 16.8687 7.01276 18.2556C8.38039 19.3474 10.114 20 12 20C13.9695 20 15.7727 19.2883 17.1666 18.1081C15.8956 16.8074 14.1219 16 12.1597 16ZM12 4C7.58172 4 4 7.58172 4 12C4 13.8106 4.6015 15.4807 5.61557 16.8214C7.25639 15.0841 9.58144 14 12.1597 14C14.6441 14 16.8933 15.0066 18.5218 16.6342C19.4526 15.3267 20 13.7273 20 12C20 7.58172 16.4183 4 12 4ZM12 5C14.2091 5 16 6.79086 16 9C16 11.2091 14.2091 13 12 13C9.79086 13 8 11.2091 8 9C8 6.79086 9.79086 5 12 5ZM12 7C10.8954 7 10 7.89543 10 9C10 10.1046 10.8954 11 12 11C13.1046 11 14 10.1046 14 9C14 7.89543 13.1046 7 12 7Z"></path></g></svg>';
    endif;

?><style>
    body{padding-bottom:42px;}
    div.k-statusbar{position:fixed;bottom:0;left:0;z-index:99999;width:100%;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";font-size:14px;height:38px;color:#2b2b2b;background:#F0F0F0;border-top:4px solid;border-color:<?=option('chrfickinger.kirby-statusbar.color'); ?>;display:flex;align-content:flex-start;align-items:center;padding:0 10px;}
    div.k-statusbar a{text-decoration:none;}
    div.k-statusbar div{display:flex;line-height:38px;}
    div.k-statusbar div svg{display:inline;margin-top:-2px;}
    div.k-statusbar div svg.status{padding-right:4px;height:16px;}
    div.k-statusbar div.template{justify-content:flex-start;margin:0 5px 0 0;}
    div.k-statusbar div.template span{border-radius:8px;color:#102e4c;background:#B7D3F0;font-size:12px;line-height:18px;padding:0 5px;}
    div.k-statusbar div.title{flex-grow:1;white-space:nowrap;overflow:hidden;}
    div.k-statusbar div.site{margin-left:2px;white-space:nowrap;}
    div.k-statusbar div.site a{border-radius:8px;background:#fff;font-size:12px;line-height:18px;padding:0 5px;margin-right:8px;border:1px solid <?=option('chrfickinger.kirby-statusbar.color'); ?>;}
    div.k-statusbar div.site span{font-weight:bold;font-size:10px;padding-left:2px;text-transform:uppercase;}
    div.k-statusbar div.site svg{padding-right:0;height:16px;fill:<?=option('chrfickinger.kirby-statusbar.color');?>;}
    div.k-statusbar div.account{flex:none;}
    div.k-statusbar div.account img{display:inline;width:22px;height:22px;margin-top:-4px;border-radius:20px;}
    div.k-statusbar div.account svg{fill:#5e5e5e;height:20px;}
    div.k-statusbar div.logout svg{fill:#5e5e5e;height:20px;margin-left:5px;}
</style>
<div class="k-statusbar">
    <div class="template"><span><?=$page->blueprint()->title() ?></span></div>
    <div class="title"><a href="<?= $page->panelUrl()->or($page->panel()->url()) ?>"><?= $pagestatus.'<span>'.$page->title()->value().'</span>'; ?></a></div>
    <div class="site"><a href="<?=Panel::url('site')?>"><svg aria-hidden="true" aria-labelledby="home" viewBox="0 0 24 24"><title id="home"><?=Panel::areas()['site']['label']?></title><g><path d="M19 21.0001H5C4.44772 21.0001 4 20.5524 4 20.0001V11.0001L1 11.0001L11.3273 1.61162C11.7087 1.26488 12.2913 1.26488 12.6727 1.61162L23 11.0001L20 11.0001V20.0001C20 20.5524 19.5523 21.0001 19 21.0001ZM13 19.0001H18V9.15757L12 3.70302L6 9.15757V19.0001H11V13.0001H13V19.0001Z"></path></g></svg><span><?=option('chrfickinger.kirby-statusbar.environment'); ?></span></a></div>
    <div class="account"><a href="<?= Panel::url('account') ?>"><?= $avatar; ?></a></div>
    <div class="logout"><a href="<?= Panel::url('logout') ?>"><svg aria-hidden="true" aria-labelledby="logout" viewBox="0 0 24 24"><title id="account"><?= t('logout') ?></title><g><path d="M5 22C4.44772 22 4 21.5523 4 21V3C4 2.44772 4.44772 2 5 2H19C19.5523 2 20 2.44772 20 3V6H18V4H6V20H18V18H20V21C20 21.5523 19.5523 22 19 22H5ZM18 16V13H11V11H18V8L23 12L18 16Z"></path></g></svg></a></div>
</div>
<?php kirby()->setCurrentTranslation(kirby()->language());