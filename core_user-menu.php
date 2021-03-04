				<!-- User menu -->
				<div class="sidebar-user">
					<div class="card-body">
						<div class="media">
							<?php /**
							<div class="mr-3">
								<a href="#"><img src="global_assets/images/placeholders/placeholder.jpg" width="38" height="38" class="rounded-circle" alt=""></a>
							</div>
							*/ ?>

							<div class="media-body">
								<div class="font-size-xs opacity-50" style="color:#333;">
									<?php if(date("H") >= 0 && date("H") < 5): ?>
									Buena noche
									<?php elseif(date("H") >= 5 && date("H") < 12): ?>
									Buen d&iacute;a
									<?php elseif (date("H") >= 12 && date("H") < 19): ?>
									Buena tarde
									<?php elseif (date("H") >= 19 && date("H") < 24): ?>
									Buena noche
									<?php endif; ?>
								</div>
								<div class="media-title font-weight-semibold" style="color:#333;"><i class="icon-user"></i> <?php echo $_SESSION["username"]; ?></div>
								<?php /**
								<div class="font-size-xs opacity-50" style="color:#333;">
									<i class="icon-pin font-size-sm"></i> &nbsp;Ciudad de M&eacute;xico
								</div>
								*/ ?>
							</div>

							<?php /**
							<div class="ml-3 align-self-center">
								<a href="#config" class="text-white"><i class="icon-cog3"></i></a>
							</div>
							*/ ?>
						</div>
					</div>
				</div>
				<!-- /user menu -->