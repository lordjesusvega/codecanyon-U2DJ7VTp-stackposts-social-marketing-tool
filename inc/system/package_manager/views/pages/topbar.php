<?php if( !_u("role") && strtotime( _u("expiration_date") . "23:59:59" ) < time() ){?>
	<span class="position-absolute w-100 text-white bg-danger l-1 t-65 p-t-16 p-b-16 p-l-25 p-r-25"><i class="far fa-bell"></i> <?php _e("Your subscription has expired. Renew your subscription so as not to interrupt your plan.")?></span>
<?php }else{?>
<div class="m-t-10 d-none d-sm-block">
    	<span class="m-r-10"><?php _e( sprintf(__("Subscription expire: %s"), date_show( _u("expiration_date") ) ) )?></span>
</div>
<?php }?>
<div class="m-r-10 m-t-2 d-none d-sm-block">
    <?php if(find_modules("payment")){ ?>
    <a href="<?php _e( get_url("pricing") )?>" class="btn btn-info text-uppercase"><?php _e("Upgrade now")?></a>
	<?php }?>
</div>